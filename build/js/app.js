function menuDropdown(){const e=document.querySelector(".dropdown-btn"),t=document.querySelector(".menu-dropdown"),i=document.querySelector("#menu-btn");e.onclick=function(){t.classList.toggle("no-display"),i.classList.toggle("active")}}document.addEventListener("DOMContentLoaded",(function(){menuDropdown(),mainSlide()}));const slider=document.querySelector(".slider"),punto=document.querySelectorAll(".punto");function mainSlide(){let e=0;const t=document.querySelector(".slider"),i=["../build/img/1.jpg","../build/img/2.jpg","../build/img/3.jpg"];document.querySelector(".next");i.forEach(l=>{const n=document.createElement("IMG");n.src=""+i[e++],n.dataset.imagenId=e,t.appendChild(n)})}function onYouTubeIframeAPIReady(){$('div[name="vp"]').each((function(){let e=$(this).attr("videoId");new YT.Player(this,{videoId:e,playerVars:{mute:1}})}))}!function(e){"use strict";e(document).ready((function(){var t=e("ul.setup-panel li a"),i=e(".setup-content");i.hide(),t.click((function(l){l.preventDefault();var n=e(e(this).attr("href")),c=e(this).closest("li");c.hasClass("disabled")||(t.closest("li").removeClass("active"),c.addClass("active"),i.hide(),n.show())})),e("ul.setup-panel li.active a").trigger("click"),e("#activate-step-2").on("click",(function(t){e("ul.setup-panel li:eq(1)").removeClass("disabled"),e('ul.setup-panel li a[href="#step-2"]').trigger("click")})),e("#activate-step-3").on("click",(function(t){e("ul.setup-panel li:eq(2)").removeClass("disabled"),e('ul.setup-panel li a[href="#step-3"]').trigger("click")})),e("#activate-step-4").on("click",(function(t){e("ul.setup-panel li:eq(3)").removeClass("disabled"),e('ul.setup-panel li a[href="#step-4"]').trigger("click")})),e("#activate-step-5").on("click",(function(t){e("ul.setup-panel li:eq(4)").removeClass("disabled"),e('ul.setup-panel li a[href="#step-5"]').trigger("click")}))}))}(jQuery),Mouseover=e=>{YT.get(e.id).playVideo()},Mouseout=e=>{YT.get(e.id).pauseVideo()};
//# sourceMappingURL=app.js.map
