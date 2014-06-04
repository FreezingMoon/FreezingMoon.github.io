function Slides(settings) {
	this.slideCount = (typeof(settings["slides"]) == "number") ? settings["slides"] : 0;
	this.time = (typeof(settings["timeout"]) == "number") ? settings["timeout"] : 0;
	this.elementType = (typeof(settings["elementType"]) == "string") ? settings["elementType"] : "#";
	this.slides = (typeof(settings["slideElement"]) == "string") ? settings["slideElement"] : "";
	this.image = (typeof(settings["imageElement"]) == "string") ? settings["imageElement"] : "";
	this.button = (typeof(settings["buttonElement"]) == "string") ? settings["buttonElement"] : "";
	this.buttonOnState = (typeof(settings["on"]) == "object") ? settings["on"] : {};
	this.buttonOffState = (typeof(settings["off"]) == "object") ? settings["off"] : {};
	
	this.timer;
	this.dir = 1;
	this.current = 0;
	this.paused = false;
	
	this.init = function() {
		var self = this;
		for(x = 1; x <= this.slideCount; x++) {
			$(this.elementType + this.button + x).mouseover(function(e){return function(){self.updateImage(e);}}(x));
			$(this.elementType + this.button + x).mouseout(function(){self.paused = false;});
		}
		$(this.elementType + this.slides).mouseover(function(){self.paused = true;});
		$(this.elementType + this.slides).mouseout(function(){self.paused = false;});
		this.updateImage(null);
		if(this.time > 0)
			timer = setInterval(function() {self.updateImage(null);}, this.time);
	}
	
	this.updateImage = function(element) {
		if(this.time > 0 && this.paused) return;
		for(x = 1; x <= this.slideCount; x++) {
			$(this.elementType + this.button + x).attr(this.buttonOffState);
			$(this.elementType + this.image + x).stop();
			if ($(this.elementType + this.image + x).css("opacity") > 0) {
				$(this.elementType + this.image +  x).animate({'opacity': 0}, 250 * $(this.elementType + this.image +  x).css("opacity"));
			}
		}
		if(element == null) {
			this.current += this.dir;
			this.current = (this.current < 1) ? this.slideCount : this.current;
			this.current = (this.current > this.slideCount) ? 1 : this.current;
			element = this.current;
		} else {
			this.paused = true;
			this.current = element;
		}
		$(this.elementType + this.button + element).attr(this.buttonOnState);
		$(this.elementType + this.image + element).css("z-index", parseInt($(this.elementType + this.image + element).css("z-index")) + 1);
		$(this.elementType + this.image + element).animate({'opacity': 1}, 250);
		for(x = 1; x <= this.slideCount; x++) {
			if(x != element)
				$(this.elementType + this.image + x).css("z-index", parseInt($(this.elementType + this.image + element).css("z-index")) - 1);
		}
	}
}