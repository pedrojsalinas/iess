!function(t,e){"use strict";var i=function(n,s){for(var r=n.split("."),o=i.Core(),a=t,h=r.length,c=0;c<h;c++)a[r[c]]=h-1===c?o:a[r[c]]||{},a=a[r[c]];return"function"==typeof s&&s.call(null,a,e,i.utils),a};i.Core=function(){var t=this,e=function(){},i=function(i){var n;return n=new e,n.$el=i,n.data=i.data(),n.elements=t.getElements(i,"element"),n.addPrefix=t.utils.addPrefix,n.prefix=t.utils.prefix,n.start.apply(n,arguments),n};return i.fn=i.prototype,e.prototype=i.fn,i.fn.start=function(){},i},i.getElements=function(t,e){var i={},n=this;return t.find("[data-"+e+"]").each(function(s,r){var o=n.utils.toDataSetName(r.dataset[e]),a="by"+n.utils.ucfirst(e);i[o]||(i[o]=t[a](r.dataset[e]))}),i},i.utils={prefix:"wpusb",addPrefix:function(t,e){var i=e||"-";return this.prefix+i+t},getGlobalVars:function(t){return(window.WPUSBVars||{})[t]},getAjaxUrl:function(){return this.getGlobalVars("ajaxUrl")},getContext:function(){return this.getGlobalVars("context")},getLocale:function(){return this.getGlobalVars("WPLANG")},getPreviewTitles:function(){return this.getGlobalVars("previewTitles")},getMinCount:function(){var t=this.getGlobalVars("minCount")||0;return parseInt(t)},getPathUrl:function(t){return decodeURIComponent(t).split(/[?#]/)[0]},getTime:function(){return(new Date).getTime()},decodeUrl:function(t){return decodeURIComponent(t)},ucfirst:function(t){return this.parseName(t,/(\b[a-z])/g)},toDataSetName:function(t){return this.parseName(t,/(-)\w/g)},hasParam:function(){return~window.location.href.indexOf("?")},isStorageAvailable:function(){return this.storageAvailable("localStorage")},getPathName:function(){return this.addPrefix(window.location.pathname,"r")},timeKey:function(){return this.strToCode(this.getPathName()+"/storage-time")},setCacheTime:function(){this.setItem(this.timeKey(),this.getTime())},setItem:function(t,e){this.isStorageAvailable()&&localStorage.setItem(t,e)},getItem:function(t){return this.isStorageAvailable()?localStorage.getItem(t):0},hasExpiredCache:function(){return!this.isStorageAvailable()||this.getTime()-this.getItem(this.timeKey())>3e5},getSpinner:function(){var t=document.createElement("img");return t.src=this.getSpinnerUrl(),t.className=this.prefix+"-spinner",t},isMobile:function(){return/Android|webOS|iPhone|iPad|iPod|BlackBerry|Tablet OS|IEMobile|Opera Mini/i.test(navigator.userAgent)},parseName:function(t,e){return t.replace(e,function(t){return t.toUpperCase()}).replace(/-/g,"")},remove:function(t){t.fadeOut("fast",function(){t.remove()})},getId:function(t){return!!t&&document.getElementById(t)},storageAvailable:function(t){try{var e=window[t],i="__storage_test__";return e.setItem(i,i),e.removeItem(i),!0}catch(t){return!1}},get:function(t,e){var i,n,s,r;if(!this.hasParam())return e||"";for(n=(i=window.location.search.substring(1).split("&")).length,r=0;r<n;r++)if((s=i[r].split("="))[0]===t)return s[1];return e||""},strToCode:function(t){var e,i=0,n=t.length;if(!n)return i;for(e=0;e<n;e++)i=(i<<5)-i+t.charCodeAt(e),i|=0;return Math.abs(i)}},t.WPUSB=i}(window,jQuery),WPUSB("WPUSB.BuildComponents",function(t,e,i){t.create=function(t){var n="[data-"+i.addPrefix("component")+"]";t.findComponent(n,e.proxy(this,"_start"))},t._start=function(t){void 0!==WPUSB.Components&&this._iterator(t)},t._iterator=function(t){var n;t.each(function(t,s){s=e(s),n=i.ucfirst(this.getComponent(s)),this._callback(n,s)}.bind(this))},t.getComponent=function(t){var e=t.data(i.addPrefix("component"));return e||""},t._callback=function(t,e){var i=WPUSB.Components[t];"function"!=typeof i?console.log('Component "'+t+'" is not a function.'):i.call(null,e)}},{}),function(t){t.fn.byElement=function(t){return this.find('[data-element="'+t+'"]')},t.fn.byAction=function(t){return this.find('[data-action="'+t+'"]')},t.fn.byReferrer=function(t){return this.find('[data-referrer="'+t+'"]')},t.fn.byComponent=function(t,e){return this.find("[data-"+e+'-component="'+t+'"]')},t.fn.addEvent=function(e,i,n){var s=WPUSB.utils.ucfirst(["_on",e,i].join("-"));this.byAction(i).on(e,t.proxy(n,s))},t.fn.findComponent=function(e,i){var n=t(this).find(e);return n.length&&"function"==typeof i&&i.call(null,n,t(this)),n.length},t.fn.isEmptyValue=function(){return!t.trim(this.val())}}(jQuery),WPUSB("WPUSB.Application",function(t,e,i){t.init=function(t){WPUSB.ProvidersProcess.create(t),WPUSB.BuildComponents.create(t),WPUSB.FixedTop.create(t),WPUSB.FixedContext.create(t)}}),WPUSB("WPUSB.Components.CounterSocialShare",function(t,e,i){t.fn.start=function(){this.isShareCountsDisabled()?this.renderExtras():this.init()},t.fn.init=function(){this.renderExtras(),this.request(!1)},t.fn.addEventListeners=function(){this.$el.addEvent("click","open-popup",this),WPUSB.ToggleButtons.create(this.$el.data("element"),this)},t.fn.request=function(t){this.setPropNames(t),this.fireRequest()},t.fn.setPropNames=function(t){this.facebook=this.elements.facebook,this.tumblr=this.elements.tumblr,this.pinterest=this.elements.pinterest,this.buffer=this.elements.buffer,this.totalShare=this.elements.totalShare,this.totalCounter=0,this.facebookCounter=0,this.tumblrCounter=0,this.pinterestCounter=0,this.bufferCounter=0,this.max=4,this.isReport=t,this.minCount=i.getMinCount()},t.fn.fireRequest=function(){this.items=[{reference:"facebookCounter",element:"facebook",url:"https://graph.facebook.com/?id=".concat(this.data.elementUrl,"&fields=og_object{engagement}")},{reference:"tumblrCounter",element:"tumblr",url:"https://api.tumblr.com/v2/share/stats?url="+this.data.elementUrl},{reference:"pinterestCounter",element:"pinterest",url:"https://api.pinterest.com/v1/urls/count.json?url="+this.data.elementUrl},{reference:"bufferCounter",element:"buffer",url:"https://api.bufferapp.com/1/links/shares.json?url="+this.data.elementUrl}],this._eachAjaxSocial()},t.fn._eachAjaxSocial=function(){this.items.forEach(this._iterateItems.bind(this))},t.fn._iterateItems=function(t,e){this.totalShare&&this.totalShare.text(0),this[t.element]&&this[t.element].text(0),this._getJSON(t)},t.fn._getJSON=function(t){var i=e.extend({dataType:"jsonp"},t),n=e.ajax(i);n.done(e.proxy(this,"_done",t)),n.fail(e.proxy(this,"_fail",t))},t.fn._done=function(t,e){var i=this.addPrefix("hide"),n=this.getNumberByData(t.element,e);this[t.reference]=n,this.max-=1,this.totalCounter+=n,this.max||!this.isReport?(this[t.element]&&(this[t.element].text(this.formatCounts(n)),n>=this.minCount&&this[t.element].removeClass(i)),!this.max&&this.totalShare&&(this.totalShare.text(this.formatCounts(this.totalCounter)),this.totalCounter>=this.minCount&&this.totalShare.closest("."+this.addPrefix("item")).removeClass(i))):this.addReport()},t.fn._fail=function(t,e,i){this[t.reference]=0,this[t.element]&&this[t.element].text(0)},t.fn.getNumberByData=function(t,e){switch(t){case"facebook":return this.getTotalShareFacebook(e.og_object);case"tumblr":return this.getTotalShareTumblr(e.response);default:return parseInt(e.count||e.shares||0)}},t.fn.getTotalShareFacebook=function(t){try{return parseInt(t.engagement.count,10)}catch(t){return 0}},t.fn.getTotalShareTumblr=function(t){return"object"==typeof t?parseInt(t.note_count||0):0},t.fn._onClickOpenPopup=function(t){i.hasExpiredCache()&&this.isShareCountsDisabled()&&!this.notReport()?this.request(!0):this.addReport()},t.fn.addReport=function(){if(i.hasExpiredCache()&&this.totalCounter&&!this.notReport()){var t={action:this.addPrefix("share_count_reports","_"),reference:this.data.attrReference,count_facebook:this.facebookCounter,count_tumblr:this.tumblrCounter,count_pinterest:this.pinterestCounter,count_buffer:this.bufferCounter,nonce:this.data.attrNonce};e.ajax({method:"POST",url:i.getAjaxUrl(),data:t}),i.setCacheTime()}},t.fn.formatCounts=function(t){switch(this.c=t.toString(),Math.pow(10,this.c.length-1)){case 1e8:return this.t(3)+this.i(3,4)+"M";case 1e7:return this.t(2)+this.i(2,3)+"M";case 1e6:return this.t(1)+this.i(1,2)+"M";case 1e5:return this.t(3)+this.i(4,3)+"K";case 1e4:return this.t(2)+this.i(2,3)+"K";case 1e3:return this.t(1)+this.i(1,2)+"K";default:return t}},t.fn.t=function(t){return this.c.substring(0,t)},t.fn.i=function(t,e){var i=this.c.substring(t,e);return i&&"0"!==i?"."+i:""},t.fn.isShareCountsDisabled=function(){return 1===this.data.disabledShareCounts},t.fn.notReport=function(){return"no"===this.data.report||this.data.isTerm},t.fn.renderExtras=function(){this.addEventListeners(),WPUSB.FeaturedReferrer.create(this.$el),WPUSB.OpenPopup.create(this.$el,this)}}),WPUSB("WPUSB.Components.ButtonsSection",function(t,e,i){var n={};t.fn.start=function(){this.id=this.$el.find("."+this.addPrefix("share a")).data("modal-id"),this.modalId=this.addPrefix("modal-container-"+this.id),this.maskId=this.addPrefix("modal-"+this.id),this.init()},t.fn.init=function(){this.setModal(),this.setMask(),WPUSB.OpenPopup.create(this.modal,this),this.addEventListener(),n[this.id]=!0},t.fn.setModal=function(){var t=this.$el.byElement(this.modalId);n[this.id]||WPUSB.vars.body.append(t.clone()),t.show(),this.modal=WPUSB.vars.body.byElement(this.modalId),this.close=this.modal.find(this.addPrefix("btn-close")),this.setSizes(),this.setPosition(),t.remove()},t.fn.setMask=function(){var t=this.$el.byElement(this.maskId);n[this.id]||WPUSB.vars.body.append(t.clone()),this.mask=WPUSB.vars.body.byElement(this.maskId),t.remove()},t.fn.addEventListener=function(){this.mask.addEvent("click","close-popup",this),this.mask.on("click",this._onClickClosePopup.bind(this)),this.$el.on("click",'[data-modal-id="'+this.id+'"]',this._onClickOpenModalNetworks.bind(this))},t.fn._onClickClosePopup=function(t){t.preventDefault(),this.closeModal()},t.fn._onClickOpenModalNetworks=function(t){t.preventDefault(),this.openModal()},t.fn.setSizes=function(){this.setTop(),this.setLeft()},t.fn.closeModal=function(){this.mask.css("opacity",0),this.mask.hide(),this.modal.hide()},t.fn.openModal=function(){this.mask.css("opacity",1),this.mask.show(),this.modal.show()},t.fn.setTop=function(){var t=.5*window.innerHeight-.5*this.modal.height();this.btnTop=t-20+"px",this.top=t+"px"},t.fn.setLeft=function(){var t=.5*window.innerWidth-.5*this.modal.width();this.btnRight=t-40+"px",this.left=t+"px"},t.fn.setPosition=function(){this.modal.css({top:this.top,left:this.left}),this.close.css({top:this.btnTop,right:this.btnRight})}}),WPUSB("WPUSB.FeaturedReferrer",function(t,e,i){t.create=function(t){this.$el=t,this.init()},t.init=function(){this.$el.attr("class").match("-fixed")||this.setReferrer()},t.setReferrer=function(){this.isMatch("twitter")||this.isMatch("t")?this.showReferrer("twitter"):this.isMatch("facebook")?this.showReferrer("facebook"):this.isMatch("linkedin")&&this.showReferrer("linkedin")},t.showReferrer=function(t){var e=i.addPrefix("referrer"),n=this.$el.byReferrer(t);this.$el.find("."+i.addPrefix("count")).remove(),this.$el.find("."+i.addPrefix("counter")).remove(),this.$el.prepend(n),n.addClass(e),this.refTitle(n)},t.refTitle=function(t){if(!t.find("span[data-title]").length){var e='<span data-title="'+t.data("ref-title")+'"></span>';t.find("a").append(e)}},t.isMatch=function(t){var e=document.referrer,i=new RegExp("^https?://([^/]+\\.)?"+t+"\\.com?(/|$)","i");return e.match(i)}},{}),WPUSB("WPUSB.FixedContext",function(t,e,i){t.create=function(t){this.$el=t.find("#"+i.addPrefix("container-fixed")),this.id=i.getContext(),this.id&&this.$el.length&&this.init()},t.init=function(){this.setContext(),this.context&&(this.setRect(),this.setLeft(this.rect.left),this.alignButtons())},t.setContext=function(){this.context=this.getElement()},t.setRect=function(){this.rect=this.context.getBoundingClientRect(),this.top=this.rect.top},t.setLeft=function(t){this.left=t-this.$el.width()},t.alignButtons=function(){this.$el.byAction("close-buttons").remove(),this.changeClass(),this.$el.css("left",this.left),this.setLeftMobile()},t.setLeftMobile=function(){window.innerWidth>769||this.$el.css("left","initial")},t.changeClass=function(){this.$el.hasClass(i.addPrefix("fixed-left"))||(this.$el.removeClass(i.addPrefix("fixed-right")),this.$el.addClass(i.addPrefix("fixed-left")))},t.getElement=function(){var t=this.id.replace(/[^A-Z0-9a-z-_]/g,""),e=i.getId(t);return!e&&this.addNotice(e,t),e},t.addNotice=function(t,e){t||console.log("WPUSB: ID ("+e+") not found")}},{}),WPUSB("WPUSB.FixedTop",function(t,e,i){t.create=function(t){this.class=i.addPrefix("fixed-top"),this.$el=t.byElement(this.class),this.$el.length&&(this.$el=e(this.$el.get(0)),this.init())},t.init=function(){this.scroll=this.$el.get(0).getBoundingClientRect(),this.isInvalidScroll()&&(this.scroll.static=450),this.context=window,this.addEventListener()},t.addEventListener=function(){e(this.context).scroll(this._setPositionFixed.bind(this))},t._setPositionFixed=function(){var t=this.scroll.static||this.scroll.top;e(this.context).scrollTop()>t?this.$el.addClass(this.class):this.$el.removeClass(this.class)},t.isInvalidScroll=function(){return 1>this.scroll.top}},{}),WPUSB("WPUSB.OpenPopup",function(t,e,i){t.create=function(t,e){this.$el=t,this.init()},t.init=function(){this.addEventListener()},t.addEventListener=function(){this.$el.addEvent("click","open-popup",this)},t._onClickOpenPopup=function(t){var i=e(t.currentTarget);this.popupCenter(i.attr("target"),i.attr("href"),"685","500"),t.preventDefault()},t.popupCenter=function(t,e,i,n){var s,r;return i=i||screen.width,n=n||screen.height,s=.5*screen.width-.5*i,r=.5*screen.height-.5*n,window.open(e,t,"menubar=no,toolbar=no,status=no,width="+i+",height="+n+",toolbar=no,left="+s+",top="+r)}},{}),WPUSB("WPUSB.ProvidersProcess",function(t,e,i){t.create=function(t){this.init()},t.init=function(){i.isMobile()&&(this.parseMessengerLink(),this.parseWhatsAppLink())},t.parseMessengerLink=function(){this.parseProviderLink("messenger")},t.parseWhatsAppLink=function(){this.parseProviderLink("whatsapp",/https?:\/\/.+?\//,!0)},t.parseProviderLink=function(t,e,i){var n,s=0,r=document.querySelectorAll("[data-"+t+"-wpusb]"),o=r.length;if(o)for(;s<o;s++)n=r[s].dataset[t+"Wpusb"],r[s].setAttribute("href",i?r[s].href.replace(e,n):n)}}),WPUSB("WPUSB.ToggleButtons",function(t,e,i){t.create=function(t,e){"fixed"===t&&(this.$el=e.$el,this.buttons=e.elements.buttons,this.init())},t.init=function(){this.addEventListener()},t.addEventListener=function(){this.$el.addEvent("click","close-buttons",this)},t._onClickCloseButtons=function(t){var n=i.addPrefix("icon-right"),s=i.addPrefix("toggle-active");this.buttons.toggleClass(i.addPrefix("buttons-hide")),e(t.currentTarget).toggleClass(n+" "+s),t.preventDefault()}}),jQuery(function(t){var e=t("body");WPUSB.vars={body:e},document.getElementsByClassName(WPUSB.utils.prefix).length&&WPUSB.Application.init.apply(WPUSB.utils,[e])});