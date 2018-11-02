$(function() {
    var Allpanel = $(".link_naiyo");
    var Allbtn = $("#link_panel .slidebtn a");
    $("#link_panel .slidebtn").each(function() {
        var panelset = $(this);
        var panelbtn = $(panelset).find("a");
        panelbtn.click(function() {
            var anchor = panelbtn.attr("href");
            if ($(anchor).css("display") == "none") {
                if ($(".link_naiyo.open").size()) {
                    $(Allbtn).removeClass("open").addClass("close");
                    $(".link_naiyo.open:not(animated)").removeClass("open").addClass("close").slideUp("fast", function() {
                        $(anchor).slideDown("fast").removeClass("close").addClass("open");
                        $(panelbtn).removeClass("close").addClass("open");
                    })
                } else {
                    $(anchor).slideDown("fast").removeClass("close").addClass("open");
                    $(panelbtn).removeClass("close").addClass("open");
                }
            } else {
                $(anchor).slideUp("fast");
                $(anchor).removeClass("open").addClass("close");
                $(panelbtn).removeClass("open").addClass("close");
            }
            return false;
        });
    });
});