if(jQuery(".blog #main .row").length)var infScroll=new InfiniteScroll(".blog #main .row",{path:".blog nav.posts-navigation .nav-previous a",append:"#main .row article.post",checkLastPage:!0,prefill:!1,responseType:"document",outlayer:!1,scrollThreshold:400,elementScroll:!1,loadOnScroll:!1,history:"append",historyTitle:!0,hideNav:"nav.posts-navigation",status:void 0,button:".view-more-button",onInit:function(){jQuery(".blog #primary").append('<div class="text-center"><button class="button view-more-button">Load more</button></div>')},debug:!1});