// Loading Animation
const loadingTimeline = anime.timeline({
    autoplay: true,
});

// Loading dots animation
loadingTimeline.add({
    targets: ".loading-dot",
    scale: [1, 1.5, 1],
    opacity: [0.5, 1, 0.5],
    duration: 800,
    delay: anime.stagger(200),
    loop: true,
    easing: "easeInOutQuad",
});

// Hide loading screen after 2.5 seconds
setTimeout(() => {
    anime({
        targets: "#loadingScreen",
        opacity: 0,
        duration: 500,
        easing: "easeOutQuad",
        complete: function () {
            document.getElementById("loadingScreen").style.display = "none";

            // Show main content with fade in
            anime({
                targets: "#mainContent",
                opacity: [0, 1],
                translateY: [30, 0],
                duration: 800,
                easing: "easeOutQuad",
            });

            // Animate hero section
            anime({
                targets: ".animate-hero",
                opacity: [0, 1],
                translateY: [50, 0],
                duration: 700,
                delay: 400,
                easing: "easeOutQuad",
            });

            // Animate feature cards
            anime({
                targets: ".animate-feature",
                opacity: [0, 1],
                translateX: [-30, 0],
                duration: 600,
                delay: anime.stagger(150, { start: 800 }),
                easing: "easeOutQuad",
            });
        },
    });
}, 2500);

// Page transition function for links
function pageTransition(url) {
    anime({
        targets: "body",
        opacity: 0,
        duration: 300,
        easing: "easeOutQuad",
        complete: function () {
            window.location.href = url;
        },
    });
}

// Update login link to use page transition
document.addEventListener("DOMContentLoaded", function () {
    const loginLinks = document.querySelectorAll('a[href="login.html"]');
    loginLinks.forEach((link) => {
        link.addEventListener("click", function (e) {
            e.preventDefault();
            pageTransition("login.html");
        });
    });
});

// Add hover animations to feature cards
document.querySelectorAll(".feature-card").forEach((card) => {
    card.addEventListener("mouseenter", function () {
        anime({
            targets: this,
            scale: 1.05,
            duration: 200,
            easing: "easeOutQuad",
        });
    });

    card.addEventListener("mouseleave", function () {
        anime({
            targets: this,
            scale: 1,
            duration: 200,
            easing: "easeOutQuad",
        });
    });
});

// Add scroll animations for images
const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
        if (entry.isIntersecting) {
            anime({
                targets: entry.target,
                opacity: [0, 1],
                translateY: [30, 0],
                duration: 800,
                easing: "easeOutQuad",
            });
        }
    });
});

document.querySelectorAll("img").forEach((img) => {
    observer.observe(img);
});
