class Navigation {
        bind() {
                var instance = this;
                $("#navigation > li > a").off("click").on("click", function (e) {
                        e.stopImmediatePropagation();
                        e.preventDefault();
                        
                        instance.removeActiveClass();
                        var href = $(this).attr('href');
                        
                        $("#content > div").hide();
                        $(href).show();
                        $(this).addClass("active");
                });
        }
        
        removeActiveClass() {
                $("#navigation > li > a").removeClass("active");
        }
        
        showHome() {
                this.bind();
                $("#content > div").hide();
                $("#home").show();
        }
}