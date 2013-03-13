/*
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2011 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */
(function() {
    if (typeof this.RokGallery == "undefined") {
        this.RokGallery = {};
    }
    this.RokGallery.Showcase = new Class({Implements:[Options,Events],options:{onJump:function(j) {
        this.animation.index = this.current;
        this.animation.setBackground(this.slices[j].getElement("img").get("src"));
        this.animation.setAnimation(this.options.animation);
        this.animation.play();
        if (this.captions.length) {
            this.adjustHeight(j);
            this.captionsAnimation.setAnimation(this.options.captions.animation);
            this.captionsAnimation.setFromTo(this.current, j);
            this.captionsAnimation.play();
        }
    },animation:"random",duration:500,imgpadding:0,captions:{fixedheight:false,animated:true,animation:"crossfade"},autoplay:{enabled:true,delay:5000,complete:function() {
        this.progress.reset();
        this.next();
    }}},initialize:function(k, j) {
        this.setOptions(j);
        this.element = document.id(k) || document.getElement(k) || null;
        this.rtl = document.id(document.body).getStyle("direction") == "rtl";
        if (!this.element) {
            throw new Error('The element "' + k + '" has not been found in the page.');
        }
        this.current = 0;
        this.container = this.element.getElement(".rg-sc-slice-container");
        this.main = this.element.getElement(".rg-sc-main");
        this.imglist = this.element.getElement(".rg-sc-img-list");
        this.slices = this.element.getElements(".rg-sc-slice");
        this.captions = this.element.getElements(".rg-sc-info");
        this.arrows = this.element.getElements(".rg-sc-controls .next, .rg-sc-controls .prev");
        this.loaderBar = this.element.getElement(".rg-sc-loader");
        this.progressBar = this.element.getElement(".rg-sc-progress");
        if (this.options.autoplay.enabled) {
            this.progress = new RokGallery.Showcase.Progress(this.progressBar, {duration:this.options.autoplay.delay,width:this.loaderBar ? this.loaderBar.getSize().x : 0,onComplete:this.options.autoplay.complete.bind(this)}).play();
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
        this.jump(0, true);
    },setup:function() {
        this.animation = new RokGallery.Showcase.Animations(this.element, {container:this.imglist,width:this.container.getSize().x,height:this.container.getSize().y,duration:this.options.duration,transition:"quad:in:out",onStart:function() {
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
            this.captionsAnimation = new RokGallery.Showcase.CaptionsAnimations(this.captions, {duration:this.options.duration});
            if (this.options.captions.fixedheight) {
                var j = 0;
                this.captions.each(function(k) {
                    if (k.offsetHeight > j) {
                        j = k.offsetHeight;
                    }
                });
                this.main.setStyle("height", j);
            }
        }
        this.fireEvent("setup");
    },setArrows:function() {
        var j;
        this.arrows.each(function(k) {
            j = k.className.contains("next") ? "next" : "previous";
            k.addEvent("click", this[j].bind(this));
        }, this);
    },adjustHeight:function(n) {
        if (this.options.captions.fixedheight) {
            return;
        }
        var m = this.captions[n].offsetHeight,l = this.container.getSize().y,k = this.main.offsetHeight,j = Math.max(m, l);
        if (k != j) {
            if (this.options.captions.animated) {
                this.main.set("tween", {duration:this.options.duration}).get("tween").start("height", j);
            } else {
                this.main.setStyle("height", j);
            }
        }
    },next:function() {
        var j = this.getNext();
        this.jump(j);
        if (this.options.autoplay.enabled && !this.progress.isPaused) {
            this.progress.play();
        }
        return this;
    },previous:function() {
        var j = this.getPrevious();
        this.jump(j);
        return this;
    },jump:function(j, k) {
        if (j == this.current && !k) {
            return this;
        }
        if (this.animation.timer) {
            return this;
        }
        if (typeof GantrySmartLoad != "undefined") {
            window.fireEvent("scroll");
        }
        this.fireEvent("jump", j);
        this.current = j;
        return this;
    },getNext:function() {
        return(this.current + 1 >= this.slices.length) ? 0 : this.current + 1;
    },getPrevious:function() {
        return(this.current - 1 < 0) ? this.slices.length - 1 : this.current - 1;
    }});
    this.RokGallery.Showcase.Progress = new Class({Extends:Fx,options:{transition:"linear",fps:24,width:100},initialize:function(k, j) {
        this.element = document.id(k);
        this.isPaused = false;
        this.parent(j);
    },set:function(j) {
        if (this.element) {
            this.element.setStyle("width", j);
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
    this.RokGallery.Showcase.Animations = new Class({Extends:Fx.CSS,options:{duration:1000,transition:"expo:in:out",animation:"crossfade",container:"",background:"",imgpadding:0,width:0,height:0,blinds:24,boxes:{rows:10,cols:24}},animations:{},animationsKeys:[],initialize:function(k, j) {
        this.isPaused = false;
        this.parent(j);
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
        this.container = new Element("div", {"class":"rg-sc-slice-animations"}).inject(this.options.container);
        this.setAnimation(this.options.animation);
    },build:function(j) {
        this.container.empty();
        this.slides.empty();
        this["build" + j.capitalize()]();
        this.elements = $$(this.slides);
    },addAnimation:function(j, k) {
        if (!this.animations[j]) {
            this.animations[j] = k;
        }
        this.animationsKeys.include(j);
    },setAnimation:function(j) {
        if (j == "random") {
            j = this.animationsKeys.getRandom();
        }
        if (!this.animations[j]) {
            this.setOptions({animation:"crossfade"});
        }
        for (var k in this.animations[j]) {
            this[k] = this.animations[j][k];
        }
        if (!this.animations[j]["blinds"]) {
            this.blinds = this.options.blinds;
        }
        if (!this.animations[j]["boxes"]) {
            this.boxes = this.options.boxes;
        }
        if (!this.animations[j]["reorder"]) {
            this.reorder = false;
        }
        this.build(this.type);
    },buildBlinds:function() {
        var l = {width:this.options.width,height:this.options.height},k = this.background,j = this.blinds,m = Math.round(l.width / j);
        this.sliceSize = {width:m,height:l.height};
        (j).times(function(o) {
            var n = ((m + (o * m)) - m);
            var p = new Element("div", {styles:{opacity:0,position:"absolute",top:this.options.imgpadding,left:(m * o) + this.options.imgpadding + "px",height:l.height + "px",width:(o == j - 1) ? l.width - (m * o) : m,background:"url(" + k + ") no-repeat -" + n + "px 0%"}}).inject(this.container);
            this.slides.push(p);
        }, this);
    },buildBoxes:function() {
        var l = {width:this.options.width,height:this.options.height},k = this.background,j = this.boxes,m = {width:Math.round(l.width / j.cols),height:Math.round(l.height / j.rows)};
        this.sliceSize = {width:m.width,height:m.height};
        (j.rows).times(function(n) {
            (j.cols).times(function(p) {
                var o = {x:(m.width + (p * m.width)) - m.width,y:(m.height + (n * m.height)) - m.height};
                var q = new Element("div", {styles:{opacity:0,position:"absolute",top:(m.height * n) + this.options.imgpadding + "px",left:(m.width * p) + this.options.imgpadding + "px",width:(p == j.cols - 1) ? l.width - (m.width * p) : m.width,height:m.height,background:"url(" + k + ") no-repeat -" + o.x + "px -" + o.y + "px"}}).inject(this.container);
                this.slides.push(q);
            }, this);
        }, this);
    },setBackground:function(j) {
        this.background = j;
    },compute:function(q, r, s) {
        var l = {};
        for (var m in q) {
            var j = q[m],n = r[m],o = l[m] = {};
            for (var k in j) {
                o[k] = this.parent(j[k], n[k], s);
            }
        }
        return l;
    },set:function(l, n) {
        var j = this.buffer = 0;
        for (var m in l) {
            if (!this.elements[m]) {
                continue;
            }
            var k = l[m];
            for (var o in k) {
                this.render.delay(n ? 0 : j, this, [this.elements[m],o,k[o],this.options.unit]);
            }
            j += this.delay;
        }
        this.buffer = j;
        return this;
    },step:function() {
        var k = Date.now();
        var j = (this.delay || 1) * this.slides.length + this.options.duration;
        if (k < this.time + this.options.duration) {
            var l = this.transition((k - this.time) / this.options.duration);
            this.set(this.compute(this.from, this.to, l));
        } else {
            if (k > this.time + j) {
                this.set(this.compute(this.from, this.to, 1));
                this.complete();
            }
        }
    },start:function(m) {
        if (!this.check(m)) {
            return this;
        }
        var s = {},t = {};
        for (var n in m) {
            if (!this.elements[n]) {
                continue;
            }
            var q = m[n],j = s[n] = {},r = t[n] = {};
            for (var k in q) {
                var o = this.prepare(this.elements[n], k, q[k]);
                j[k] = o.from;
                r[k] = o.to;
            }
        }
        var l = this.options.duration;
        this.options.duration = Fx.Durations[l] || l.toInt();
        this.from = s;
        this.to = t;
        this.time = 0;
        this.transition = this.getTransition();
        this.startTimer();
        this.onStart();
        return this;
    },reset:function(j, k) {
        var l = {};
        (this.elements.length).times(function(m) {
            l[m] = j;
        }, this);
        this.set(l, k);
    },play:function(k) {
        var l = {};
        k = k || this.properties;
        if (this.direction == "left") {
            this.elements.reverse();
        }
        if (this.reorder) {
            this.elements = this.reorder.bind(this, [this.elements])();
        }
        for (var m in k) {
            switch (typeof k[m]) {
                case"object":
                case"array":
                    var j = k[m];
                    j.each(function(o, n) {
                        if (typeof o == "string") {
                            k[m][n] = o.replace("%height2%", this.sliceSize.height * 2).replace("%width2%", this.sliceSize.width * 2).replace("%height%", this.sliceSize.height).replace("%width%", this.sliceSize.width).toInt();
                        }
                        if (["top","right","bottom","left"].contains(m) && !k[m][n]) {
                            k[m][n] += this.options.imgpadding;
                        }
                    }, this);
                    break;
                case"string":
                    k[m] = k[m].replace("%height2%", this.sliceSize.height * 2).replace("%width2%", this.sliceSize.width * 2).replace("%height%", this.sliceSize.height).replace("%width%", this.sliceSize.width).toInt();
                    if (["top","right","bottom","left"].contains(m) && !k[m][i]) {
                        k[m][i] += this.options.imgpadding;
                    }
                    break;
            }
        }
        (this.elements.length).times(function(n) {
            l[n] = k;
        }, this);
        this.start(l);
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
        this.timer = g(this);
        return true;
    },startTimer:function() {
        if (this.timer) {
            return false;
        }
        this.time = Date.now() - this.time;
        this.timer = c(this);
        return true;
    }});
    var f = {},e = {};
    var a = function() {
        for (var j = this.length; j--;) {
            if (this[j]) {
                this[j].step();
            }
        }
    };
    var c = function(j) {
        var l = j.options.fps,k = f[l] || (f[l] = []);
        k.push(j);
        if (!e[l]) {
            e[l] = a.periodical(Math.round(1000 / l), k);
        }
        return true;
    };
    var g = function(j) {
        var l = j.options.fps,k = f[l] || [];
        k.erase(j);
        if (!k.length && e[l]) {
            e[l] = clearInterval(e[l]);
        }
        return false;
    };
    this.RokGallery.Showcase.CaptionsAnimations = new Class({Extends:Fx.Elements,options:{duration:1000,transition:"expo:in:out",link:"cancel",animation:"crossfade"},animations:{},animationsKeys:[],initialize:function(k, j) {
        this.parent(j);
        this.isPaused = false;
        this.elements = this.subject = $$(k);
        this.properties = {};
        this.setAnimation(this.options.animation);
        this.setFromTo(0, 0);
    },addAnimation:function(j, k) {
        if (!this.animations[j]) {
            this.animations[j] = k;
        }
        this.animationsKeys.include(j);
    },setAnimation:function(j) {
        if (j == "random") {
            j = this.animationsKeys.getRandom();
        }
        if (!this.animations[j]) {
            this.setOptions({animation:"crossfade"});
        }
        this.properties = {};
        for (var k in this.animations[j]) {
            this.properties[k] = this.animations[j][k];
        }
    },setFromTo:function(k, j) {
        this.fromCaption = this.elements[k] ? k : 0;
        this.toCaption = this.elements[j] ? j : 0;
    },reset:function(j, k) {
        var l = {};
        (this.elements.length).times(function(m) {
            l[m] = j;
        }, this);
        this.set(l, k);
    },play:function(k) {
        var o = {},n = {},m = {};
        k = k || this.properties;
        var l = {width:this.elements[this.fromCaption].offsetWidth,height:this.elements[this.fromCaption].offsetHeight},j = {width:this.elements[this.toCaption].offsetWidth,height:this.elements[this.toCaption].offsetHeight};
        if (this.fromCaption != this.toCaption) {
            o[this.fromCaption] = k.current;
            o[this.toCaption] = k.next;
        } else {
            o[this.toCaption] = k.next;
        }
        for (var p in o[this.fromCaption]) {
            o[this.fromCaption][p].each(function(r, q) {
                if (typeof r == "string") {
                    o[this.fromCaption][p][q] = r.replace("%height2%", l.width * 2).replace("%width2%", l.width * 2).replace("%height%", l.height).replace("%width%", l.width).toInt();
                }
            }, this);
        }
        for (var p in o[this.toCaption]) {
            o[this.toCaption][p].each(function(r, q) {
                if (typeof r == "string") {
                    o[this.toCaption][p][q] = r.replace("%height2%", j.height * 2).replace("%width2%", j.width * 2).replace("%height%", j.height).replace("%width%", j.width).toInt();
                }
            }, this);
        }
        this.start(o);
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
        this.timer = g(this);
        return true;
    },startTimer:function() {
        if (this.timer) {
            return false;
        }
        this.time = Date.now() - this.time;
        this.timer = c(this);
        return true;
    }});
    var b = {crossfade:{current:{opacity:[1,0]},next:{opacity:[0,1]}},topdown:{current:{opacity:[1,0],top:[0,"%height%"]},next:{opacity:[0,1],top:["-%height%",0]}},bottomup:{current:{opacity:[1,0],top:[0,"-%height%"]},next:{opacity:[0,1],top:["%height2%",0]}}};
    var h = {crossfade:{type:"blinds",blinds:1,delay:0,direction:"right",properties:{opacity:[0,1]}},blindsRight:{type:"blinds",direction:"right",delay:50,properties:{opacity:[0,1]}},blindsLeft:{type:"blinds",direction:"left",delay:50,properties:{opacity:[0,1]}},blindsDownLeft:{type:"blinds",direction:"left",delay:50,properties:{width:[0,"%width%"],height:[0,"%height%"],opacity:[0,1]}},blindsDownRight:{type:"blinds",direction:"right",delay:50,properties:{width:[0,"%width%"],height:[0,"%height%"],opacity:[0,1]}},boxesOpacityRight:{type:"boxes",direction:"right",delay:6,properties:{opacity:[0,1]}},boxesOpacityLeft:{type:"boxes",direction:"left",delay:6,properties:{opacity:[0,1]}},slideDown:{type:"boxes",boxes:{cols:1,rows:1},direction:"right",delay:200,properties:{height:[0,"%height%"],opacity:[0,1]}},slideUp:{type:"boxes",boxes:{cols:1,rows:1},direction:"right",delay:200,properties:{top:["%height%",0],opacity:[0,1]}},slideLeft:{type:"boxes",boxes:{cols:1,rows:1},direction:"left",delay:200,properties:{left:["-%width%",0],opacity:[0,1]}},slideRight:{type:"boxes",boxes:{cols:1,rows:1},direction:"right",delay:200,properties:{left:["%width%",0],opacity:[0,1]}},boxesRight:{type:"boxes",direction:"right",delay:6,properties:{width:[0,"%width%"],height:[0,"%height%"],opacity:[0,1]}},boxesLeft:{type:"boxes",direction:"left",delay:6,properties:{width:[0,"%width%"],height:[0,"%height%"],opacity:[0,1]}},boxesMirror:{type:"boxes",direction:"left",reorder:function(n) {
        var m = [];
        for (var l = 0,k = n.length - 1; l < n.length / 2; l++,k--) {
            m.push(n[l]);
            m.push(n[k]);
        }
        return $$(m);
    },delay:6,properties:{opacity:[0,1],width:[0,"%width%"],height:[0,"%height%"]}},boxesRandom:{type:"boxes",direction:"right",reorder:function(k) {
        var j = k;
        j.sort(function() {
            return 0.5 - Math.random();
        });
        return $$(j);
    },delay:4,properties:{opacity:[0,1]}},blindsMirrorIn:{type:"blinds",direction:"left",reorder:function(n) {
        var m = [];
        for (var l = 0,k = n.length - 1; l < n.length / 2; l++,k--) {
            m.push(n[l]);
            m.push(n[k]);
        }
        return $$(m);
    },delay:50,properties:{opacity:[0,1],width:[0,"%width%"],height:[0,"%height%"]}},blindsMirrorOut:{type:"blinds",direction:"left",reorder:function(n) {
        var m = [];
        for (var l = 0,k = n.length - 1; l < n.length / 2; l++,k--) {
            m.push(n[l]);
            m.push(n[k]);
        }
        m.reverse();
        return $$(m);
    },delay:50,properties:{opacity:[0,1],width:[0,"%width%"],height:[0,"%height%"]}},blindsRandom:{type:"blinds",direction:"right",reorder:function(k) {
        var j = k;
        j.sort(function() {
            return 0.5 - Math.random();
        });
        return $$(j);
    },delay:35,properties:{opacity:[0,1]}}};
    for (var d in h) {
        this.RokGallery.Showcase.Animations.prototype.addAnimation(d, h[d]);
    }
    for (var d in b) {
        this.RokGallery.Showcase.CaptionsAnimations.prototype.addAnimation(d, b[d]);
    }
}());
