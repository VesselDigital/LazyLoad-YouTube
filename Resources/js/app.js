(function() {

    var elements = document.querySelectorAll("[data-lazyload-youtube]");

    var makeVideoiFrame = function(id) {
        var iframe = document.createElement("iframe");
        iframe.width = 500;
        iframe.height = 281;
        iframe.src = "https://www.youtube.com/embed/"+ id +"?feature=oembed&autoplay=1";
        iframe.frameBorder = "0";
        iframe.allow = "accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share";
        iframe.allowFullscreen = true;

        return iframe;
    }

    var initLazyLoadPlayer = function(el) {
        // No id? We skip
        if(el.dataset["id"] === undefined) return;

        var thumbnailWrapper = el.querySelector(".lzlyoutube-thumbnail");
        var id = el.dataset["id"];
        var iFrame = makeVideoiFrame(id);
    
        thumbnailWrapper.addEventListener("click", function(e) {
            el.removeChild(thumbnailWrapper);
            el.append(iFrame);
            e.preventDefault();
        });

    }

    for(var i = 0; i < elements.length; i ++) {
        initLazyLoadPlayer(elements[i]);
    }

})();