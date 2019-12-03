/**
 * 
 * Find more about the scrolling function at
 * http://cubiq.org/scrolling-div-on-iphone-ipod-touch/5
 *
 * Copyright (c) 2009 Matteo Spinelli, http://cubiq.org/
 * Released under MIT license
 * http://cubiq.org/dropbox/mit-license.txt
 * 
 * Version 2.3 - Last updated: 2009.07.09
 * Modified to support horizontal scroll by phoenix3200 and rpetrich
 * 
 */

function iScroll(el)
{
	//this.wrapper = wrapper;
	//this.element = wrapper.children[0];//firstChild;
	//this.images = this.element.children
	//this.lastIndex = this.images.length-1;
	//this.pips = this.element.nextSibling;
	
	this.element = el.children[0];
	var images = this.element.children;
	this.imageCount = images.length;
	this.pips = el.children[1];
	
	this.respondsToTouches = (typeof(window.orientation) == "number");
	
//	document.getElementsByName("img").length;
	
	
	//var elt=document.getElementById("pips");
	var width = 0;
	if (this.pips)
	{
		var i=0;
		var maxheight = 0;
		for(i=0; i<this.imageCount; i++)
		{
			if(this.respondsToTouches)
			{
				this.pips.innerHTML = this.pips.innerHTML + '<img src="Http://damar1st.de/html/menu/pip.png" name="pip" style="opacity:0.3; margin: 0px 5px" />';
			}
			
			width += images[i].width + 2 + 20;
			if(images[i].height > maxheight)
				maxheight = images[i].height;
		}
		/*
		for(i=0; i<this.imageCount; i++)
		{
			images[i].style.marginBottom += maxheight/2 - images[i].height/2;
		}
		*/
		images[0].style.marginLeft = 160 - (images[0].width + 2)/2;
	}
	width += images[0].offsetLeft + 20;
	
	if(this.respondsToTouches)
	{
		this.idx = 0;
	}
	else
	{
		el.style.overflowX = 'scroll';
		el.style.height = 380 + 'px';
	}
	
//	var width = 91+ this.imageCount * 229;//1005;//this.imageCount * 230 + 70;
	
	
	this.element.style.width = width + 'px';
//	this.imageCount = el.images.length;
	
	this.position = 0;
	this.vertical = 0;
	this.refresh();
	this.element.style.webkitTransitionTimingFunction = 'cubic-bezier(0, 0, 0.2, 1)';
	this.acceleration = 0.009;

	if(this.respondsToTouches)
	{
		this.element.addEventListener('touchstart', this, false);
	}
//	this.element.addEventListener('gesturestart', this, false);
//	this.element.addEventListener('gesturechange', this, false);
}

iScroll.prototype = {
	handleEvent: function(e) {
		switch(e.type) {
			case 'touchstart': this.onTouchStart(e); break;
			case 'touchmove': this.onTouchMove(e); break;
			case 'touchend': this.onTouchEnd(e); break;
//			case 'gesturestart': e.preventDefault(); break;
//			case 'gesturechange': e.preventDefault(); break;
			case 'webkitTransitionEnd': this.onTransitionEnd(e); break;
		}
	},

	get position() {
		return this._position;
	},
	
	set position(pos) {
		this._position = pos;
		this.element.style.webkitTransform = 'translate3d(' + this._position + 'px, 0, 0)';//'translate3d(0, ' + this._position + 'px, 0)';
	},
	
	get idx()
	{
		return this._idx;
		
	},
	
	set idx(idx)
	{
		this._idx = idx;
		var pips = this.pips.children;//document.getElementsByName("pip");
		var i=0;
		for(i=0; i<pips.length; i++)
		{
			if(idx == i)
				pips[i].style.opacity = 1.0;
			else
				pips[i].style.opacity = 0.3;
		}
		
	},
	
	refresh: function() {
		this.element.style.webkitTransitionDuration = '0';

		if( this.element.offsetWidth<this.element.parentNode.clientWidth )
			this.maxScroll = 0;
		else		
			this.maxScroll = this.element.parentNode.clientWidth - this.element.offsetWidth;
	},
	
	onTouchStart: function(e) {
		
		this.element.style.webkitTransitionDuration = '0';	// Remove any transition
		var theTransform = window.getComputedStyle(this.element).webkitTransform;
		theTransform = new WebKitCSSMatrix(theTransform).m41;
		if( theTransform!=this.position )
			this.position = theTransform;

		this.startX = e.targetTouches[0].clientX;
		this.startY = e.targetTouches[0].clientY;
		this.firstMove = true;
		this.scrollStartX = this.position;
		this.scrollStartTime = e.timeStamp;
		this.moved = false;

		this.element.addEventListener('touchmove', this, false);
		this.element.addEventListener('touchend', this, false);
		
		return false;
	},
	
	onTouchMove: function(e) {
		if (this.firstMove) {
			this.firstMove = false;
			this.inMove = Math.abs(e.targetTouches[0].clientX - this.startX) > Math.abs(e.targetTouches[0].clientY - this.startY);
			if (this.inMove)
			{
//				this.element.parentNode.webkitTransitionDuration = 
				this.element.parentNode.scrollIntoView(true);
			}
		}
		if (!this.inMove)
			return false;
		e.preventDefault();
		if( e.targetTouches.length != 1 )
			return false;
		
		var leftDelta = e.targetTouches[0].clientX - this.startX;
		if( this.position>0 || this.position<this.maxScroll ) leftDelta/=2;
		this.position = this.position + leftDelta;
		this.startX = e.targetTouches[0].clientX;
		this.moved = true;

		// Prevent slingshot effect
		if( e.timeStamp-this.scrollStartTime>100 ) {
			this.scrollStartX = this.position;
			this.scrollStartTime = e.timeStamp;
		}

		return false;
	},
	
	onTouchEnd: function(e) {
		
		this.element.removeEventListener('touchmove', this, false);
		this.element.removeEventListener('touchend', this, false);

		// If we are outside of the boundaries, let's go back to the sheepfold
		
		/*
		if( this.position>0 || this.position<this.maxScroll ) {
			this.element.style.webkitTransitionTimingFunction = 'cubic-bezier(0, 0, 0.2, 1)';
			this.scrollTo(this.position>0 ? 0 : this.maxScroll);
			return false;
		}
		*/
		
		
		/*
		if( !this.moved ) {
			var theTarget = e.target;
			if(theTarget.nodeType == 3) theTarget = theTarget.parentNode;
			var theEvent = document.createEvent("MouseEvents");
			theEvent.initEvent('click', true, true);
			theTarget.dispatchEvent(theEvent);
			return false
		}
		*/
		
		// Lame formula to calculate a fake deceleration
		var scrollDistance = this.position - this.scrollStartX;
		var scrollDuration = e.timeStamp - this.scrollStartTime;

		var newDuration = (2 * scrollDistance / scrollDuration) / this.acceleration;
		var newScrollDistance = (this.acceleration / 2) * (newDuration * newDuration);
		
		if( newDuration<0 ) {
			newDuration = -newDuration;
			newScrollDistance = -newScrollDistance;
		}
		
		var speed = scrollDistance / scrollDuration;
		if(speed < 0)
			speed = -speed;
		
		var ict = this.imageCount - 1;
		
		// find closest element
		
		var images = this.element.children;
		var imagesCt = images.length;
		var offset = images[0].offsetLeft;
		var idxClose = -1;
		var distClose = 100000;//this.position;
//		if(distClose < 0)
//			distClose = -distClose;
		
		var i=0;
		for(i=0; i<imagesCt; i++)
		{
			var dist = this.position + (images[i].offsetLeft - offset);
			if(dist < 0)
				dist = -dist;
			if(dist < distClose)
			{
				idxClose = i;
				distClose = dist;
			}
		}
		this.idx = idxClose;//Math.round(this.position * ict / this.maxScroll);
		var newPosition = offset - images[this.idx].offsetLeft + images[0].width/2 - images[this.idx].width/2;
		
//		this.maxScroll/ict * this.idx;

		if(speed > 0.15)
//		if( newDuration > 0.1 + "s")
		{
			if(this.position - newPosition < 0 && scrollDistance < 0)
			{
				this.idx = this.idx + 1;
			}
			if(this.position - newPosition > 0 && scrollDistance > 0)
			{
				this.idx = this.idx - 1;
			}
			if(this.idx < 0)
				this.idx = 0;
			if(this.idx >= imagesCt)
				this.idx = imagesCt - 1;
			newPosition = offset - images[this.idx].offsetLeft + images[0].width/2 - images[this.idx].width/2;
			//newPosition = offset - images[idxClose].offsetLeft;//this.maxScroll/ict * this.idx;
			
			var newScrollDistance = newPosition - this.position;
			if(newScrollDistance < 0)
				newScrollDistance = -newScrollDistance;
			
			if(speed < 0.7)
				newScrollDistance = newScrollDistance * speed /50;//10;
			else
				newScrollDistance = newScrollDistance / 500;
			
			this.element.style.webkitTransitionTimingFunction = 'cubic-bezier(0, 0, 0.2, 1)';
			this.scrollTo(newPosition, newScrollDistance + 's');// 
			return false;
		}
		else
		{
			
			var newScrollDistance = newPosition - this.position;
			if(newScrollDistance < 0)
				newScrollDistance = -newScrollDistance;
			newScrollDistance = newScrollDistance * 5;
			
			this.element.style.webkitTransitionTimingFunction = 'cubic-bezier(0, 0, 0.2, 1)';
			this.scrollTo(newPosition, newScrollDistance + 'ms');
			return false;
		}
		/*
		else
		{
			var newPosition = this.maxScroll/3 * Math.round(this.position * 3 / this.maxScroll);
			
			var newScrollDistance = newPosition - this.position;
			if(newScrollDistance < 0)
				newScrollDistance = -newScrollDistance;
			
			var newDuration = Math.sqrt(newScrollDistance / (this.acceleration / 2));
			this.scrollTo(newPosition, newDuration);
			return false;
		}
		*/
		
		
		

		var newPosition = this.position + newScrollDistance;
		
		if( newPosition>this.element.parentNode.clientWidth/2 )
			newPosition = this.element.parentNode.clientWidth/2;
		else if( newPosition>0 )
			newPosition/= 1.5;
		else if( newPosition<this.maxScroll-this.element.parentNode.clientWidth/2 )
			newPosition = this.maxScroll-this.element.parentNode.clientWidth/2;
		else if( newPosition<this.maxScroll )
			newPosition = (newPosition - this.maxScroll) / 1.5 + this.maxScroll;
		else
			newDuration*= 6;

		this.element.style.webkitTransitionTimingFunction = 'cubic-bezier(0, 0, 0.2, 1)';
		this.scrollTo(newPosition, Math.round(newDuration) + 'ms');

		return false;
	},
	
	onTransitionEnd: function() {
		this.element.removeEventListener('webkitTransitionEnd', this, false);
		this.element.style.webkitTransitionTimingFunction = 'cubic-bezier(1, 0.2, 0.2, 1)';
		this.scrollTo( this.position>0 ? 0 : this.maxScroll );
	},
	
	scrollTo: function(dest, runtime) {
		this.element.style.webkitTransitionDuration = runtime ? runtime : '300ms';
		this.position = dest ? dest : 0;

		// If we are outside of the boundaries at the end of the transition go back to the sheepfold
		if( this.position>0 || this.position<this.maxScroll )
			this.element.addEventListener('webkitTransitionEnd', this, false);
	}
};