    document.addEventListener("DOMContentLoaded", function() {
        var dropdowns = document.querySelectorAll(".menu-dropdown-wrapper");
        dropdowns.forEach(function(dropdown) {
            dropdown.addEventListener("click", function(event) {
                // Schließe alle Dropdowns außer dem geklickten
                dropdowns.forEach(function(item) {
                    if (item !== dropdown) {
                        item.querySelector(".menu-dropdown-card").classList.remove("open");
                        item.querySelector(".menu-dropdown-card").classList.add("closed");
                        item.querySelector(".menu-dropdown_svg").style.transform = "rotate(0deg)";
                    }
                });
                
                // Toggle die Klasse des geklickten Dropdowns
                var dropdownCard = dropdown.querySelector(".menu-dropdown-card");
                if (dropdownCard.classList.contains("closed")) {
                    dropdownCard.classList.remove("closed");
                    dropdownCard.classList.add("open");
                    dropdown.querySelector(".menu-dropdown_svg").style.transform = "rotate(45deg)";
                } else {
                    dropdownCard.classList.remove("open");
                    dropdownCard.classList.add("closed");
                    dropdown.querySelector(".menu-dropdown_svg").style.transform = "rotate(0deg)";
                }
            });
        });
    });


  document.addEventListener("DOMContentLoaded", function() {
    var links = document.querySelectorAll(".menu-link_title");
    var dropdowns = document.querySelectorAll(".menu-dropdown-wrapper");

    links.forEach(function(link) {
        if (link.href === window.location.href) {
            link.classList.add("active-link");
        }
    });

    dropdowns.forEach(function(dropdown) {
        var dropdownLinks = dropdown.querySelectorAll(".menu-link_title");

        var isActive = Array.from(dropdownLinks).some(function(link) {
            return link.href === window.location.href;
        });

        if (isActive) {
            dropdown.querySelector(".u-d-inline-block").classList.add("active");
        }
    });
});

