/*
 * jquery.tools 1.1.1 - The missing UI library for the Web
 * 
 * [tools.tabs-1.0.3, tools.tabs.slideshow-1.0.1, tools.tabs.history-1.0.1, tools.scrollable-1.1.1, tools.scrollable.circular-0.5.1, tools.scrollable.autoscroll-1.0.1, tools.scrollable.navigator-1.0.1, tools.scrollable.mousewheel-1.0.1]
 * 
 * Copyright (c) 2009 Tero Piirainen
 * http://flowplayer.org/tools/
 *
 * Dual licensed under MIT and GPL 2+ licenses
 * http://www.opensource.org/licenses
 * 
 * -----
 * 
 * jquery.event.wheel.js - rev 1 
 * Copyright (c) 2008, Three Dub Media (http://threedubmedia.com)
 * Liscensed under the MIT License (MIT-LICENSE.txt)
 * http://www.opensource.org/licenses/mit-license.php
 * Created: 2008-07-01 | Updated: 2008-07-14
 * 
 * -----
 * 
 * File generated: Mon Sep 21 07:34:04 GMT+00:00 2009
 */
(function(d){d.tools=d.tools||{};d.tools.slidetabs={version:"1.0.3",conf:{slidetabs:"a",current:"current",onBeforeClick:null,onClick:null,effect:"default",initialIndex:0,event:"click",api:false,rotate:false},addEffect:function(e,f){c[e]=f}};var c={"default":function(f,e){this.getPanes().hide().eq(f).show();e.call()},fade:function(g,e){var f=this.getConf(),h=f.fadeOutSpeed,j=this.getCurrentPane();if(h){j.fadeOut(h)}else{j.hide()}this.getPanes().eq(g).fadeIn(f.fadeInSpeed,e)},slide:function(f,e){this.getCurrentPane().slideUp(200);this.getPanes().eq(f).slideDown(400,e)},ajax:function(f,e){this.getPanes().eq(0).load(this.getTabs().eq(f).attr("href"),e)}};var b;d.tools.slidetabs.addEffect("horizontal",function(f,e){if(!b){b=this.getPanes().eq(0).width()}this.getCurrentPane().animate({width:0},function(){d(this).hide()});this.getPanes().eq(f).animate({width:b},function(){d(this).show();e.call()})});function a(g,h,f){var e=this,j=d(this),i;d.each(f,function(k,l){if(d.isFunction(l)){j.bind(k,l)}});d.extend(this,{click:function(k){var o=e.getCurrentPane();var l=g.eq(k);if(typeof k=="string"&&k.replace("#","")){l=g.filter("[href*="+k.replace("#","")+"]");k=Math.max(g.index(l),0)}if(f.rotate){var m=g.length-1;if(k<0){return e.click(m)}if(k>m){return e.click(0)}}if(!l.length){if(i>=0){return e}k=f.initialIndex;l=g.eq(k)}var n=d.Event("onBeforeClick");j.trigger(n,[k]);if(n.isDefaultPrevented()){return}if(k===i){return e}l.addClass(f.current);c[f.effect].call(e,k,function(){j.trigger("onClick",[k])});g.removeClass(f.current);l.addClass(f.current);i=k;return e},getConf:function(){return f},getTabs:function(){return g},getPanes:function(){return h},getCurrentPane:function(){return h.eq(i)},getCurrentTab:function(){return g.eq(i)},getIndex:function(){return i},next:function(){return e.click(i+1)},prev:function(){return e.click(i-1)},bind:function(k,l){j.bind(k,l);return e},onBeforeClick:function(k){return this.bind("onBeforeClick",k)},onClick:function(k){return this.bind("onClick",k)},unbind:function(k){j.unbind(k);return e}});g.each(function(k){d(this).bind(f.event,function(l){e.click(k);return l.preventDefault()})});if(location.hash){e.click(location.hash)}else{e.click(f.initialIndex)}h.find("a[href^=#]").click(function(){e.click(d(this).attr("href"))})}d.fn.slidetabs=function(i,f){var g=this.eq(typeof f=="number"?f:0).data("slidetabs");if(g){return g}if(d.isFunction(f)){f={onBeforeClick:f}}var h=d.extend({},d.tools.slidetabs.conf),e=this.length;f=d.extend(h,f);this.each(function(l){var j=d(this);var k=j.find(f.slidetabs);if(!k.length){k=j.children()}var m=i.jquery?i:j.children(i);if(!m.length){m=e==1?d(i):j.parent().find(i)}g=new a(k,m,f);j.data("slidetabs",g)});return f.api?g:this}})(jQuery);
(function(b){var a=b.tools.slidetabs;a.plugins=a.plugins||{};a.plugins.slideshow={version:"1.0.1",conf:{next:".forward",prev:".backward",disabledClass:"disabled",autoplay:false,autopause:true,interval:3000,clickable:false,api:false}};b.prototype.slideshow=function(e){var f=b.extend({},a.plugins.slideshow.conf),c=this.length,d;e=b.extend(f,e);this.each(function(){var p=b(this),m=p.slidetabs(),i=b(m),o=m;b.each(e,function(t,u){if(b.isFunction(u)){m.bind(t,u)}});function n(t){return c==1?b(t):p.parent().find(t)}var s=n(e.next).click(function(){m.next()});var q=n(e.prev).click(function(){m.prev()});var h,j,l,g=false;b.extend(m,{play:function(){if(h){return}var t=b.Event("onBeforePlay");i.trigger(t);if(t.isDefaultPrevented()){return m}g=false;h=setInterval(m.next,e.interval);i.trigger("onPlay");m.next()},pause:function(){if(!h){return m}var t=b.Event("onBeforePause");i.trigger(t);if(t.isDefaultPrevented()){return m}h=clearInterval(h);l=clearInterval(l);i.trigger("onPause")},stop:function(){m.pause();g=true},onBeforePlay:function(t){return m.bind("onBeforePlay",t)},onPlay:function(t){return m.bind("onPlay",t)},onBeforePause:function(t){return m.bind("onBeforePause",t)},onPause:function(t){return m.bind("onPause",t)}});if(e.autopause){var k=m.getTabs().add(s).add(q).add(m.getPanes());k.hover(function(){m.pause();j=clearInterval(j)},function(){if(!g){j=setTimeout(m.play,e.interval)}})}if(e.autoplay){l=setTimeout(m.play,e.interval)}else{m.stop()}if(e.clickable){m.getPanes().click(function(){m.next()})}if(!m.getConf().rotate){var r=e.disabledClass;if(!m.getIndex()){q.addClass(r)}m.onBeforeClick(function(t){if(!t){q.addClass(r)}else{q.removeClass(r);if(t==m.getTabs().length-1){s.addClass(r)}else{s.removeClass(r)}}})}});return e.api?d:this}})(jQuery);
(function(d){var a=d.tools.slidetabs;a.plugins=a.plugins||{};a.plugins.history={version:"1.0.1",conf:{api:false}};var e,b;function c(f){if(f){var g=b.contentWindow.document;g.open().close();g.location.hash=f}}d.fn.onHash=function(g){var f=this;if(d.browser.msie&&d.browser.version<"8"){if(!b){b=d("<iframe/>").attr("src","javascript:false;").hide().get(0);d("body").append(b);setInterval(function(){var i=b.contentWindow.document,j=i.location.hash;if(e!==j){d.event.trigger("hash",j);e=j}},100);c(location.hash||"#")}f.bind("click.hash",function(h){c(d(this).attr("href"))})}else{setInterval(function(){var j=location.hash;var i=f.filter("[href$="+j+"]");if(!i.length){j=j.replace("#","");i=f.filter("[href$="+j+"]")}if(i.length&&j!==e){e=j;d.event.trigger("hash",j)}},100)}d(window).bind("hash",g);return this};d.fn.history=function(g){var h=d.extend({},a.plugins.history.conf),f;g=d.extend(h,g);this.each(function(){var k=d(this).slidetabs(),j=k.getTabs(),i=k;j.onHash(function(l,m){if(!m||m=="#"){m=k.getConf().initialIndex}k.click(m)});j.click(function(l){location.hash=d(this).attr("href").replace("#","")})});return g.api?f:this}})(jQuery);
(function(c){c.tools=c.tools||{};c.tools.scrollable={version:"1.1.1",conf:{size:5,vertical:false,speed:400,keyboard:true,keyboardSteps:null,disabledClass:"disabled",hoverClass:null,clickable:true,activeClass:"active",easing:"swing",loop:false,items:".items",item:null,prev:".prev",next:".next",prevPage:".prevPage",nextPage:".nextPage",api:false}};var d,a=0;function b(q,o,m){var t=this,r=c(this),e=!o.vertical,f=q.children(),l=0,j;if(!d){d=t}c.each(o,function(u,v){if(c.isFunction(v)){r.bind(u,v)}});if(f.length>1){f=c(o.items,q)}function n(v){var u=c(v);return m==1||u.length==1||o.globalNav?u:q.parent().find(v)}q.data("finder",n);var g=n(o.prev),i=n(o.next),h=n(o.prevPage),p=n(o.nextPage);c.extend(t,{getIndex:function(){return l},getClickIndex:function(){var u=t.getItems();return u.index(u.filter("."+o.activeClass))},getConf:function(){return o},getSize:function(){return t.getItems().size()},getPageAmount:function(){return Math.ceil(this.getSize()/o.size)},getPageIndex:function(){return Math.ceil(l/o.size)},getNaviButtons:function(){return g.add(i).add(h).add(p)},getRoot:function(){return q},getItemWrap:function(){return f},getItems:function(){return f.children(o.item)},getVisibleItems:function(){return t.getItems().slice(l,l+o.size)},seekTo:function(u,y,v){if(u<0){u=0}if(l===u){return t}if(y===undefined){y=o.speed}if(c.isFunction(y)){v=y;y=o.speed}if(u>t.getSize()-o.size){return o.loop?t.begin():this.end()}var w=t.getItems().eq(u);if(!w.length){return t}var x=c.Event("onBeforeSeek");r.trigger(x,[u]);if(x.isDefaultPrevented()){return t}function z(){if(v){v.call(t)}r.trigger("onSeek",[u])}if(e){f.animate({left:-w.position().left},y,o.easing,z)}else{f.animate({top:-w.position().top},y,o.easing,z)}d=t;l=u;return t},move:function(w,v,u){j=w>0;return this.seekTo(l+w,v,u)},next:function(v,u){return this.move(1,v,u)},prev:function(v,u){return this.move(-1,v,u)},movePage:function(y,x,w){j=y>0;var u=o.size*y;var v=l%o.size;if(v>0){u+=(y>0?-v:o.size-v)}return this.move(u,x,w)},prevPage:function(v,u){return this.movePage(-1,v,u)},nextPage:function(v,u){return this.movePage(1,v,u)},setPage:function(v,w,u){return this.seekTo(v*o.size,w,u)},begin:function(v,u){j=false;return this.seekTo(0,v,u)},end:function(v,u){j=true;var w=this.getSize()-o.size;return w>0?this.seekTo(w,v,u):t},reload:function(){r.trigger("onReload");return t},bind:function(u,v){r.bind(u,v);return t},onBeforeSeek:function(u){return this.bind("onBeforeSeek",u)},onSeek:function(u){return this.bind("onSeek",u)},onReload:function(u){return this.bind("onReload",u)},unbind:function(u){r.unbind(u);return t},focus:function(){d=t;return t},click:function(w){var x=t.getItems().eq(w),u=o.activeClass,v=o.size;if(w<0||w>=t.getSize()){return t}if(v==1){if(o.loop){return t.next()}if(w===0||w==t.getSize()-1){j=(j===undefined)?true:!j}return j===false?t.prev():t.next()}if(v==2){if(w==l){w--}t.getItems().removeClass(u);x.addClass(u);return t.seekTo(w,time,fn)}if(!x.hasClass(u)){t.getItems().removeClass(u);x.addClass(u);var z=Math.floor(v/2);var y=w-z;if(y>t.getSize()-v){y=t.getSize()-v}if(y!==w){return t.seekTo(y)}}return t}});g.addClass(o.disabledClass).click(function(){t.prev()});i.click(function(){t.next()});p.click(function(){t.nextPage()});h.addClass(o.disabledClass).click(function(){t.prevPage()});t.onSeek(function(v,u){if(u===0){g.add(h).addClass(o.disabledClass)}else{g.add(h).removeClass(o.disabledClass)}if(u>=t.getSize()-o.size){i.add(p).addClass(o.disabledClass)}else{i.add(p).removeClass(o.disabledClass)}});var k=o.hoverClass,s="keydown."+Math.random().toString().substring(10);t.onReload(function(){if(k){t.getItems().hover(function(){c(this).addClass(k)},function(){c(this).removeClass(k)})}if(o.clickable){t.getItems().each(function(u){c(this).unbind("click.scrollable").bind("click.scrollable",function(v){if(c(v.target).is("a")){return}return t.click(u)})})}if(o.keyboard){c(document).unbind(s).bind(s,function(u){if(u.altKey||u.ctrlKey){return}if(o.keyboard!="static"&&d!=t){return}var v=o.keyboardSteps;if(e&&(u.keyCode==37||u.keyCode==39)){t.move(u.keyCode==37?-v:v);return u.preventDefault()}if(!e&&(u.keyCode==38||u.keyCode==40)){t.move(u.keyCode==38?-v:v);return u.preventDefault()}return true})}else{c(document).unbind(s)}});t.reload()}c.fn.scrollable=function(e){var f=this.eq(typeof e=="number"?e:0).data("scrollable");if(f){return f}var g=c.extend({},c.tools.scrollable.conf);e=c.extend(g,e);e.keyboardSteps=e.keyboardSteps||e.size;a+=this.length;this.each(function(){f=new b(c(this),e);c(this).data("scrollable",f)});return e.api?f:this}})(jQuery);
(function(b){var a=b.tools.scrollable;a.plugins=a.plugins||{};a.plugins.circular={version:"0.5.1",conf:{api:false,clonedClass:"cloned"}};b.fn.circular=function(e){var d=b.extend({},a.plugins.circular.conf),c;b.extend(d,e);this.each(function(){var i=b(this).scrollable(),n=i.getItems(),k=i.getConf(),f=i.getItemWrap(),j=0;if(i){c=i}if(n.length<k.size){return false}n.slice(0,k.size).each(function(o){b(this).clone().appendTo(f).click(function(){i.click(n.length+o)}).addClass(d.clonedClass)});var l=b.makeArray(n.slice(-k.size)).reverse();b(l).each(function(o){b(this).clone().prependTo(f).click(function(){i.click(-o-1)}).addClass(d.clonedClass)});var m=f.children(k.item);var h=k.hoverClass;if(h){m.hover(function(){b(this).addClass(h)},function(){b(this).removeClass(h)})}function g(o){var p=m.eq(o);if(k.vertical){f.css({top:-p.position().top})}else{f.css({left:-p.position().left})}}g(k.size);b.extend(i,{move:function(s,r,p,q){var u=j+s+k.size;var t=u>i.getSize()-k.size;if(u<0||t){var o=j+k.size+(t?-n.length:n.length);g(o);u=o+s}if(q){m.removeClass(k.activeClass).eq(u+Math.floor(k.size/2)).addClass(k.activeClass)}if(u===j+k.size){return self}return i.seekTo(u,r,p)},begin:function(p,o){return this.seekTo(k.size,p,o)},end:function(p,o){return this.seekTo(n.length,p,o)},click:function(p,r,q){if(!k.clickable){return self}if(k.size==1){return this.next()}var s=p-j,o=k.activeClass;s-=Math.floor(k.size/2);return this.move(s,r,q,true)},getIndex:function(){return j},setPage:function(p,q,o){return this.seekTo(p*k.size+k.size,q,o)},getPageAmount:function(){return Math.ceil(n.length/k.size)},getPageIndex:function(){if(j<0){return this.getPageAmount()-1}if(j>=n.length){return 0}return(j+k.size)/k.size-1},getVisibleItems:function(){var o=j+k.size;return m.slice(o,o+k.size)}});i.onSeek(function(p,o){j=o-k.size;i.getNaviButtons().removeClass(k.disabledClass)});i.getNaviButtons().removeClass(k.disabledClass)});return d.api?c:this}})(jQuery);
(function(b){var a=b.tools.scrollable;a.plugins=a.plugins||{};a.plugins.autoscroll={version:"1.0.1",conf:{autoplay:true,interval:3000,autopause:true,steps:1,api:false}};b.fn.autoscroll=function(d){if(typeof d=="number"){d={interval:d}}var e=b.extend({},a.plugins.autoscroll.conf),c;b.extend(e,d);this.each(function(){var g=b(this).scrollable();if(g){c=g}var i,f,h=true;g.play=function(){if(i){return}h=false;i=setInterval(function(){g.move(e.steps)},e.interval);g.move(e.steps)};g.pause=function(){i=clearInterval(i)};g.stop=function(){g.pause();h=true};if(e.autopause){g.getRoot().add(g.getNaviButtons()).hover(function(){g.pause();clearInterval(f)},function(){if(!h){f=setTimeout(g.play,e.interval)}})}if(e.autoplay){setTimeout(g.play,e.interval)}});return e.api?c:this}})(jQuery);
(function(b){var a=b.tools.scrollable;a.plugins=a.plugins||{};a.plugins.navigator={version:"1.0.1",conf:{navi:".navi",naviItem:null,activeClass:"active",indexed:false,api:false}};b.fn.navigator=function(d){var e=b.extend({},a.plugins.navigator.conf),c;if(typeof d=="string"){d={navi:d}}d=b.extend(e,d);this.each(function(){var i=b(this).scrollable(),f=i.getRoot(),l=f.data("finder").call(null,d.navi),g=null,k=i.getNaviButtons();if(i){c=i}i.getNaviButtons=function(){return k.add(l)};function j(){if(!l.children().length||l.data("navi")==i){l.empty();l.data("navi",i);for(var m=0;m<i.getPageAmount();m++){l.append(b("<"+(d.naviItem||"a")+"/>"))}g=l.children().each(function(n){b(this).click(function(o){i.setPage(n);return o.preventDefault()});if(d.indexed){b(this).text(n)}})}else{g=d.naviItem?l.find(d.naviItem):l.children();g.each(function(n){var o=b(this);o.click(function(p){i.setPage(n);return p.preventDefault()})})}g.eq(0).addClass(d.activeClass)}i.onSeek(function(n){var m=d.activeClass;g.removeClass(m).eq(i.getPageIndex()).addClass(m)});i.onReload(function(){j()});j();var h=g.filter("[href="+location.hash+"]");if(h.length){i.move(g.index(h))}});return d.api?c:this}})(jQuery);
/*(function(b){b.fn.wheel=function(e){return this[e?"bind":"trigger"]("wheel",e)};b.event.special.wheel={setup:function(){b.event.add(this,d,c,{})},teardown:function(){b.event.remove(this,d,c)}};var d=!b.browser.mozilla?"mousewheel":"DOMMouseScroll"+(b.browser.version<"1.9"?" mousemove":"");function c(e){switch(e.type){case"mousemove":return b.extend(e.data,{clientX:e.clientX,clientY:e.clientY,pageX:e.pageX,pageY:e.pageY});case"DOMMouseScroll":b.extend(e,e.data);e.delta=-e.detail/3;break;case"mousewheel":e.delta=e.wheelDelta/120;break}e.type="wheel";return b.event.handle.call(this,e,e.delta)}var a=b.tools.scrollable;a.plugins=a.plugins||{};a.plugins.mousewheel={version:"1.0.1",conf:{api:false,speed:50}};b.fn.mousewheel=function(f){var g=b.extend({},a.plugins.mousewheel.conf),e;if(typeof f=="number"){f={speed:f}}f=b.extend(g,f);this.each(function(){var h=b(this).scrollable();if(h){e=h}h.getRoot().wheel(function(i,j){h.move(j<0?1:-1,f.speed||50);return false})});return f.api?e:this}})(jQuery);*/
