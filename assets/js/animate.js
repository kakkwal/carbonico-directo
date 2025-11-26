// Animations

gsap.registerPlugin(ScrollTrigger);

/**
 * Detect device is tactile
 */
const isTouchDevice = () => {
	return "ontouchstart" in window || navigator.maxTouchPoints > 0 || navigator.msMaxTouchPoints > 0;
};

const displayEl = () => {
	if (isTouchDevice()) return;

	document.fonts.ready.then(() => {
		const sections = document.querySelectorAll("section:not(.banner):not(.lastorder):not(.neworder):not(#home .products)");
		
		sections.forEach((s) => {
			const isWideScreen = window.innerWidth >= 1215;
			if (isWideScreen) {
				gsap.from(s, {
					opacity: 0,
					y: 50,
					duration: 1.2,
					ease: "power3.out",
					scrollTrigger: {
						trigger: s,
						end: "bottom 80%",
						scrub: true,
					},
				});
			}
		});
	});
};

window.addEventListener("DOMContentLoaded", displayEl);
