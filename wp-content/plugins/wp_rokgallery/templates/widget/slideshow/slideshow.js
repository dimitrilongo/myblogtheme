/*
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2011 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */
(function() {
    if (typeof this.RokGallery == "undefined") {
        this.RokGallery = {};
    }
    Element.implement({sumStyles:function() {
        var j = this.getStyles(arguments),i = 0;
        for (var h in j) {
            i += j[h].toInt();
        }
        return i;
    }});
    Elements.implement({sumStyles:function(i) {
        var h = 0;
        this.each(function(j) {
            h += j.sumStyles(i);
        }, this);
        return h;
    }});
    this.RokGallery.Slideshow = new Class({Implements:[Options,Events],options:{onJump:function(h) {
        this.animation.index = this.current;
        this.animation.setBackground(this.slices[h].getElement("img").get("src"));
        this.animation.setAnimation(this.options.animation);
        this.animation.play();
        if (this.captions.length) {
            if (this.current == h) {
                this.captions[h].fade("in");
            } else {
                this.captions[this.current].fade("out");
                this.captions[h].fade("in");
            }
        }
    },animation:"random",duration:500,autoplay:{enabled:true,delay:5000,complete:function() {
        this.progress.reset();
        this.next();
    }}},initialize:function(i, h) {
        this.setOptions(h);
        this.element = document.id(i) || document.getElement(i) || null;
        this.rtl = document.id(document.body).getStyle("direction") == "rtl";
        if (!this.element) {
            throw new Error('The element "' + i + '" has not been found in the page.');
        }
        this.current = 0;
        this.container = this.element.getElement(".rg-ss-slice-container");
        this.slices = this.element.getElements(".rg-ss-slice");
        this.captions = this.element.getElements(".rg-ss-info");
        this.arrows = this.element.getElements(".rg-ss-controls .next, .rg-ss-controls .prev");
        this.scrollerContainer = this.element.getElement(".rg-ss-thumb-scroller");
        this.loaderBar = this.element.getElement(".rg-ss-loader");
        this.progressBar = this.element.getElement(".rg-ss-progress");
        if (this.options.autoplay.enabled) {
            this.progress = new RokGallery.Slideshow.Progress(this.progressBar, {duration:this.options.autoplay.delay,width:this.loaderBar ? this.loaderBar.getSize().x : 0,onComplete:this.options.autoplay.complete.bind(this)}).play();
            this.bounds = {progress:{mouseenter:this.progress.pause.bind(this.progress),mouseleave:this.progress.resume.bind(this.progress)}};
            this.element.addEvents(this.bounds.progress);
        } else {
            if (this.loaderBar) {
                this.loaderBar.setStyle("display", "none");
            }
        }
        this.setup();
        if (this.arrows.length) {
            this.setArrows();
        }
        if (this.scrollerContainer) {
            this.setNavigation();
        }
        this.jump(0, true);
    },setup:function() {
        this.animation = new RokGallery.Slideshow.Animations(this.element, {container:this.container,width:this.container.getSize().x,height:this.container.getSize().y,duration:this.options.duration,transition:"quad:in:out",onStart:function() {
            if (this.options.autoplay.enabled) {
                this.progress.pause();
            }
        }.bind(this),onComplete:function() {
            this.slices[this.current].setStyle("display", "block");
            if (this.current != this.animation.index) {
                this.slices[this.animation.index].setStyle("display", "none");
            }
            this.animation.clean();
            if (this.options.autoplay.enabled) {
                this.progress.play();
            }
        }.bind(this)});
        if (this.captions.length) {
            this.captions.setStyles({display:"block",opacity:0,visibility:"hidden"});
            this.captions.set("tween", {duration:this.options.duration,transition:"quad:in:out"});
        }
        this.fireEvent("setup");
    },setArrows:function() {
        var h;
        this.arrows.each(function(i) {
            h = i.className.contains("next") ? "next" : "previous";
            i.addEvent("click", this[h].bind(this));
        }, this);
    },setNavigation:function() {
        this.scroller = new RokGallery.Slideshow.Thumbnails(this.element, this, {});
    },next:function() {
        var h = this.getNext();
        this.jump(h);
        if (this.options.autoplay.enabled && !this.progress.isPaused) {
            this.progress.play();
        }
        return this;
    },previous:function() {
        var h = this.getPrevious();
        this.jump(h);
        return this;
    },jump:function(h, i) {
        if (h == this.current && !i) {
            return this;
        }
        if (this.animation.timer) {
            return this;
        }
        this.fireEvent("jump", h);
        if (this.scrollerContainer) {
            this.scroller.setActive(h);
            this.scroller.toThumb(h);
        }
        this.current = h;
        return this;
    },getNext:function() {
        return(this.current + 1 >= this.slices.length) ? 0 : this.current + 1;
    },getPrevious:function() {
        return(this.current - 1 < 0) ? this.slices.length - 1 : this.current - 1;
    }});
    this.RokGallery.Slideshow.Progress = new Class({Extends:Fx,options:{transition:"linear",fps:24,width:100},initialize:function(i, h) {
        this.element = document.id(i);
        this.isPaused = false;
        this.parent(h);
    },set:function(h) {
        if (this.element) {
            this.element.setStyle("width", h);
        }
        return this;
    },reset:function() {
        this.set(0);
        return this;
    },play:function() {
        this.start(0, this.options.width);
        return this;
    },pause:function() {
        this.isPaused = true;
        return this.parent();
    },resume:function() {
        this.isPaused = false;
        return this.parent();
    }});
    this.RokGallery.Slideshow.Thumbnails = new Class({Implements:[Options,Events],options:{onClickElement:function(h, i) {
        if (this.base.animation.timer) {
            return this;
        }
        this.base.jump(i);
        this.setActive(i);
        return this;
    },scroller:{duration:300,transition:Fx.Transitions.Expo.easeInOut}},initialize:function(i, j, h) {
        this.setOptions(h);
        this.base = j;
        this.element = i;
        this.thumbSize = 0;
        this.wrapper = this.element.getElement(".rg-ss-navigation-container");
        this.container = this.wrapper.getElement(".rg-ss-thumb-scroller");
        this.arrows = this.wrapper.getElements(".rg-ss-arrow-left, .rg-ss-arrow-right");
        this.list = this.wrapper.getElement(".rg-ss-thumb-list");
        this.thumbsWrapper = this.wrapper.getElements(".rg-ss-thumb-list .rg-ss-thumb");
        this.thumbs = this.wrapper.getElements(".rg-ss-thumb-list .rg-ss-thumb img");
        this.arrowsSize = this.arrows.sumStyles("width");
        this.scroller = new Fx.Scroll(this.container, this.options.scroller);
        this.scroller.set(0, 0);
        this.setup();
        this.attach();
        return this;
    },attach:function() {
        this.thumbsWrapper.each(function(h, j) {
            h.bounds = {click:this.clickElement.bindWithEvent(this, h)};
            h.addEvents(h.bounds);
        }, this);
        this.arrows.each(function(j, h) {
            j.bounds = {click:this.arrowsClick.bindWithEvent(this, [j,(!h ? "left" : "right")])};
            j.addEvent("dblclick", function(i) {
                i.stop();
            });
            j.addEvents(j.bounds);
        }, this);
    },detach:function() {
        this.thumbsWrapper.each(function(h, j) {
            h.removeEvents(h.bounds);
        }, this);
        this.arrows.removeEvents(this.bounds.arrows);
    },arrowsClick:function(j, k, l) {
        j.stop();
        var h = this.container.scrollLeft + (l == "left" ? -this.thumbSize : +this.thumbSize),i = this.container.scrollWidth - this.container.offsetWidth,m = this.container.scrollLeft + this.thumbSize;
        if (i - m < this.thumbSize) {
            h += i - m;
        }
        if (m - this.thumbSize * 2 < this.thumbSize && l == "left") {
            h = 0;
        }
        this.scroller.start(h, 0);
    },toThumb:function(h) {
        this.scroller.start(this.thumbSize * h, 0);
    },clickElement:function(j, h) {
        if (j) {
            j.stop();
        }
        var i = this.thumbsWrapper.indexOf(h);
        this.fireEvent("clickElement", [h,i]);
    },setup:function() {
        var h = 0,i = [];
        ["padding-%x","border-%x-width","margin-%x"].each(function(j) {
            ["left","right"].each(function(k) {
                i.push(j.replace(/%x/g, k));
            });
        });
        this.thumbs.each(function(j, k) {
            this.thumbSize = this.thumbsWrapper[k].sumStyles(i) + (j.get("width") || this.thumbsWrapper[k].offsetWidth || 0).toInt();
            h += this.thumbSize;
        }, this);
        this.list.setStyle("width", h);
        if (h < this.wrapper.offsetWidth - this.arrowsSize) {
            this.wrapper.removeClass("arrows-enabled");
        } else {
            this.wrapper.addClass("arrows-enabled");
        }
    },setActive:function(h) {
        this.thumbsWrapper.removeClass("active");
        this.thumbsWrapper[h].addClass("active");
    }});
    this.RokGallery.Slideshow.Animations = new Class({Extends:Fx.CSS,options:{duration:1000,transition:"expo:in:out",animation:"crossfade",container:"",background:"",width:0,height:0,blinds:24,boxes:{rows:10,cols:24}},animations:{},animationsKeys:[],initialize:function(i, h) {
        this.isPaused = false;
        this.parent(h);
        this.slides = [];
        this.originalDuration = this.options.duration;
        this.delay = 0;
        this.type = "blinds";
        this.background = this.options.background;
        this.blinds = 1;
        this.boxes = {rows:1,cols:1};
        this.properties = {};
        this.direction = "right";
        this.reorder = false;
        this.container = new Element("div", {"class":"rg-ss-slice-animations"}).inject(this.options.container);
        this.setAnimation(this.options.animation);
    },build:function(h) {
        this.container.empty();
        this.slides.empty();
        this["build" + h.capitalize()]();
        this.elements = $$(this.slides);
    },addAnimation:function(h, i) {
        if (!this.animations[h]) {
            this.animations[h] = i;
        }
        this.animationsKeys.include(h);
    },setAnimation:function(h) {
        if (h == "random") {
            h = this.animationsKeys.getRandom();
        }
        if (!this.animations[h]) {
            this.setOptions({animation:"crossfade"});
        }
        for (var i in this.animations[h]) {
            this[i] = this.animations[h][i];
        }
        if (!this.animations[h]["blinds"]) {
            this.blinds = this.options.blinds;
        }
        if (!this.animations[h]["boxes"]) {
            this.boxes = this.options.boxes;
        }
        if (!this.animations[h]["reorder"]) {
            this.reorder = false;
        }
        this.build(this.type);
    },buildBlinds:function() {
        var j = {width:this.options.width,height:this.options.height},i = this.background,h = this.blinds,k = Math.round(j.width / h);
        this.sliceSize = {width:k,height:j.height};
        (h).times(function(m) {
            var l = ((k + (m * k)) - k);
            var n = new Element("div", {styles:{opacity:0,position:"absolute",top:0,left:(k * m) + "px",height:j.height + "px",width:(m == h - 1) ? j.width - (k * m) : k,background:"url(" + i + ") no-repeat -" + l + "px 0%"}}).inject(this.container);
            this.slides.push(n);
        }, this);
    },buildBoxes:function() {
        var j = {width:this.options.width,height:this.options.height},i = this.background,h = this.boxes,k = {width:Math.round(j.width / h.cols),height:Math.round(j.height / h.rows)};
        this.sliceSize = {width:k.width,height:k.height};
        (h.rows).times(function(l) {
            (h.cols).times(function(n) {
                var m = {x:(k.width + (n * k.width)) - k.width,y:(k.height + (l * k.height)) - k.height};
                var o = new Element("div", {styles:{opacity:0,position:"absolute",top:(k.height * l) + "px",left:(k.width * n) + "px",width:(n == h.cols - 1) ? j.width - (k.width * n) : k.width,height:k.height,background:"url(" + i + ") no-repeat -" + m.x + "px -" + m.y + "px"}}).inject(this.container);
                this.slides.push(o);
            }, this);
        }, this);
    },setBackground:function(h) {
        this.background = h;
    },compute:function(o, q, r) {
        var k = {};
        for (var l in o) {
            var h = o[l],m = q[l],n = k[l] = {};
            for (var j in h) {
                n[j] = this.parent(h[j], m[j], r);
            }
        }
        return k;
    },set:function(k, m) {
        var h = this.buffer = 0;
        for (var l in k) {
            if (!this.elements[l]) {
                continue;
            }
            var j = k[l];
            for (var n in j) {
                this.render.delay(m ? 0 : h, this, [this.elements[l],n,j[n],this.options.unit]);
            }
            h += this.delay;
        }
        this.buffer = h;
        return this;
    },step:function() {
        var i = Date.now();
        var h = (this.delay || 1) * this.slides.length + this.options.duration;
        if (i < this.time + this.options.duration) {
            var j = this.transition((i - this.time) / this.options.duration);
            this.set(this.compute(this.from, this.to, j));
        } else {
            if (i > this.time + h) {
                this.set(this.compute(this.from, this.to, 1));
                this.complete();
            }
        }
    },start:function(l) {
        if (!this.check(l)) {
            return this;
        }
        var r = {},s = {};
        for (var m in l) {
            if (!this.elements[m]) {
                continue;
            }
            var o = l[m],h = r[m] = {},q = s[m] = {};
            for (var j in o) {
                var n = this.prepare(this.elements[m], j, o[j]);
                h[j] = n.from;
                q[j] = n.to;
            }
        }
        var k = this.options.duration;
        this.options.duration = Fx.Durations[k] || k.toInt();
        this.from = r;
        this.to = s;
        this.time = 0;
        this.transition = this.getTransition();
        this.startTimer();
        this.onStart();
        return this;
    },reset:function(h, i) {
        var j = {};
        (this.elements.length).times(function(k) {
            j[k] = h;
        }, this);
        this.set(j, i);
    },play:function(i) {
        var j = {};
        i = i || this.properties;
        if (this.direction == "left") {
            this.elements.reverse();
        }
        if (this.reorder) {
            this.elements = this.reorder.bind(this, [this.elements])();
        }
        for (var k in i) {
            switch (typeof i[k]) {
                case"object":
                case"array":
                    var h = i[k];
                    h.each(function(m, l) {
                        if (typeof m == "string") {
                            i[k][l] = m.replace("%height2%", this.sliceSize.height * 2).replace("%width2%", this.sliceSize.width * 2).replace("%height%", this.sliceSize.height).replace("%width%", this.sliceSize.width).toInt();
                        }
                    }, this);
                    break;
                case"string":
                    i[k] = i[k].replace("%height2%", this.sliceSize.height * 2).replace("%width2%", this.sliceSize.width * 2).replace("%height%", this.sliceSize.height).replace("%width%", this.sliceSize.width).toInt();
                    break;
            }
        }
        (this.elements.length).times(function(l) {
            j[l] = i;
        }, this);
        this.start(j);
        return this;
    },complete:function() {
        if (this.stopTimer()) {
            this.onComplete();
        }
        return this;
    },cancel:function() {
        if (this.stopTimer()) {
            this.onCancel();
        }
        return this;
    },onStart:function() {
        this.fireEvent("start", this.subject);
    },onComplete:function() {
        this.fireEvent("complete", this.subject);
        if (!this.callChain()) {
            this.fireEvent("chainComplete", this.subject);
        }
    },onCancel:function() {
        this.fireEvent("cancel", this.subject).clearChain();
    },pause:function() {
        this.isPaused = true;
        this.stopTimer();
        return this;
    },resume:function() {
        this.isPaused = false;
        this.startTimer();
        return this;
    },clean:function() {
        $$(this.slides).dispose();
        this.slides.empty();
        return this;
    },stopTimer:function() {
        if (!this.timer) {
            return false;
        }
        this.time = Date.now() - this.time;
        this.timer = f(this);
        return true;
    },startTimer:function() {
        if (this.timer) {
            return false;
        }
        this.time = Date.now() - this.time;
        this.timer = b(this);
        return true;
    }});
    var e = {},d = {};
    var a = function() {
        for (var h = this.length; h--;) {
            if (this[h]) {
                this[h].step();
            }
        }
    };
    var b = function(h) {
        var j = h.options.fps,i = e[j] || (e[j] = []);
        i.push(h);
        if (!d[j]) {
            d[j] = a.periodical(Math.round(1000 / j), i);
        }
        return true;
    };
    var f = function(h) {
        var j = h.options.fps,i = e[j] || [];
        i.erase(h);
        if (!i.length && d[j]) {
            d[j] = clearInterval(d[j]);
        }
        return false;
    };
    var g = {crossfade:{type:"blinds",blinds:1,delay:0,direction:"right",properties:{opacity:[0,1]}},blindsRight:{type:"blinds",direction:"right",delay:50,properties:{opacity:[0,1]}},blindsLeft:{type:"blinds",direction:"left",delay:50,properties:{opacity:[0,1]}},blindsDownLeft:{type:"blinds",direction:"left",delay:50,properties:{width:[0,"%width%"],height:[0,"%height%"],opacity:[0,1]}},blindsDownRight:{type:"blinds",direction:"right",delay:50,properties:{width:[0,"%width%"],height:[0,"%height%"],opacity:[0,1]}},boxesOpacityRight:{type:"boxes",direction:"right",delay:6,properties:{opacity:[0,1]}},boxesOpacityLeft:{type:"boxes",direction:"left",delay:6,properties:{opacity:[0,1]}},slideDown:{type:"boxes",boxes:{cols:1,rows:1},direction:"right",delay:200,properties:{height:[0,"%height%"],opacity:[0,1]}},slideUp:{type:"boxes",boxes:{cols:1,rows:1},direction:"right",delay:200,properties:{top:["%height%",0],opacity:[0,1]}},slideLeft:{type:"boxes",boxes:{cols:1,rows:1},direction:"left",delay:200,properties:{left:["-%width%",0],opacity:[0,1]}},slideRight:{type:"boxes",boxes:{cols:1,rows:1},direction:"right",delay:200,properties:{left:["%width%",0],opacity:[0,1]}},boxesRight:{type:"boxes",direction:"right",delay:6,properties:{width:[0,"%width%"],height:[0,"%height%"],opacity:[0,1]}},boxesLeft:{type:"boxes",direction:"left",delay:6,properties:{width:[0,"%width%"],height:[0,"%height%"],opacity:[0,1]}},boxesMirror:{type:"boxes",direction:"left",reorder:function(m) {
        var l = [];
        for (var k = 0,h = m.length - 1; k < m.length / 2; k++,h--) {
            l.push(m[k]);
            l.push(m[h]);
        }
        return $$(l);
    },delay:6,properties:{opacity:[0,1],width:[0,"%width%"],height:[0,"%height%"]}},boxesRandom:{type:"boxes",direction:"right",reorder:function(i) {
        var h = i;
        h.sort(function() {
            return 0.5 - Math.random();
        });
        return $$(h);
    },delay:4,properties:{opacity:[0,1]}},blindsMirrorIn:{type:"blinds",direction:"left",reorder:function(m) {
        var l = [];
        for (var k = 0,h = m.length - 1; k < m.length / 2; k++,h--) {
            l.push(m[k]);
            l.push(m[h]);
        }
        return $$(l);
    },delay:50,properties:{opacity:[0,1],width:[0,"%width%"],height:[0,"%height%"]}},blindsMirrorOut:{type:"blinds",direction:"left",reorder:function(m) {
        var l = [];
        for (var k = 0,h = m.length - 1; k < m.length / 2; k++,h--) {
            l.push(m[k]);
            l.push(m[h]);
        }
        l.reverse();
        return $$(l);
    },delay:50,properties:{opacity:[0,1],width:[0,"%width%"],height:[0,"%height%"]}},blindsRandom:{type:"blinds",direction:"right",reorder:function(i) {
        var h = i;
        h.sort(function() {
            return 0.5 - Math.random();
        });
        return $$(h);
    },delay:35,properties:{opacity:[0,1]}}};
    for (var c in g) {
        this.RokGallery.Slideshow.Animations.prototype.addAnimation(c, g[c]);
    }
}());
