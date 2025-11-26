document.addEventListener("DOMContentLoaded", function () {
	const bannerLinks = document.querySelectorAll(".banner__wrapper a");

	bannerLinks.forEach((link, index) => {
		if ((index + 1) % 2 === 0) {
			link.classList.add("button-secondary");
		} else {
			link.classList.add("button-primary");
		}
	});
});

if (document.querySelector(".swiper-products")) {
	const swiper = new Swiper(".swiper-products", {
		slidesPerView: "auto",
		direction: "horizontal",
		spaceBetween: 30,
		loop: true,
		slideRole: "",
		a11y: false,
		allowTouchMove: false,
		navigation: {
			prevEl: ".chevron-prev",
			nextEl: ".chevron-next",
		},
	});
}

document.addEventListener("DOMContentLoaded", () => {
	const asksItems = document.querySelectorAll(".asks__list__asks__ask");

	if (asksItems) {
		asksItems.forEach((item) => {
			item.addEventListener("click", () => {
				item.classList.toggle("expanded");
			});
		});
	}
});

document.addEventListener("DOMContentLoaded", function () {
	const products = document.querySelectorAll(".product__top");

	if (products) {
		products.forEach((item) => {
			item.addEventListener("click", () => {
				const li = item.closest(".product");
				li.classList.toggle("expanded");
			});
		});
	}
});

document.addEventListener("DOMContentLoaded", function () {
	const productsContainer = document.querySelector(".products-list");
	const cartItems = document.getElementById("cart-items");

	function updateCart() {
		const products = [];
		const productElements = productsContainer.querySelectorAll(".product");

		productElements.forEach((productEl) => {
			const productName = productEl.querySelector("h3").textContent;
			const bigInput = productEl.querySelector('input[type="number"].big');
			const mediumInput = productEl.querySelector('input[type="number"].medium');

			const bigQty = parseInt(bigInput.value) || 0;
			const mediumQty = parseInt(mediumInput.value) || 0;

			if (bigQty > 0 || mediumQty > 0) {
				products.push({
					name: productName,
					big: bigQty,
					medium: mediumQty,
				});
			}
		});

		const returnBig = parseInt(document.querySelector('input[name="return_big"]').value) || 0;
		const returnMedium = parseInt(document.querySelector('input[name="return_medium"]').value) || 0;

		const hiddenCartInput = document.querySelector('input[name="cart_data"]');
		const cartData = {
			products: products,
			return: {
				big: returnBig,
				medium: returnMedium,
			},
		};

		hiddenCartInput.value = JSON.stringify(cartData);

		cartItems.innerHTML = "";

		const cartWrapper = document.querySelector(".cart__wrapper");
		const emptyText = cartWrapper.dataset.emptyText;
		const bigText = cartWrapper.dataset.bigText;
		const mediumText = cartWrapper.dataset.mediumText;
		const returnText = cartWrapper.dataset.returnText;

		if (products.length === 0 && returnBig === 0 && returnMedium === 0) {
			cartItems.innerHTML = `<li class="empty">${emptyText}</li>`;
		} else {
			products.forEach((product) => {
				const li = document.createElement("li");
				li.className = "cart-item";

				let bigHtml = "";
				let mediumHtml = "";
				if (product.big > 0) {
					bigHtml = `
						<div class="big-bottle">
							<h4>${bigText}</h4>
							<p>${product.big}</p>
						</div>
					`;
				}
				if (product.medium > 0) {
					mediumHtml += `
						<div class="medium-bottle">
							<h4>${mediumText}</h4>
							<p>${product.medium}</p>
						</div>
					`;
				}

				li.innerHTML = `
					<h3>${product.name}</h3>
					<div class="results">
						${bigHtml}
						${mediumHtml}
					</div>
				`;
				cartItems.appendChild(li);
			});

			if (returnBig > 0 || returnMedium > 0) {
				const returnLi = document.createElement("li");
				returnLi.className = "cart-item return-item";

				let returnBigHtml = "";
				let returnMediumHtml = "";
				if (returnBig > 0) {
					returnBigHtml = `
						<div class="big-bottle">
							<h4>${bigText}</h4>
							<p>${returnBig}</p>
						</div>
					`;
				}
				if (returnMedium > 0) {
					returnMediumHtml += `
						<div class="medium-bottle">
							<h4>${mediumText}</h4>
							<p>${returnMedium}</p>
						</div>
					`;
				}

				returnLi.innerHTML = `
					<h3>${returnText}</h3><br>
					<div class="results">
						${returnBigHtml}
						${returnMediumHtml}
					</div>
				`;
				cartItems.appendChild(returnLi);
			}
		}

		return cartData;
	}

	function clearCart(e) {
		e.preventDefault();

		const productElements = productsContainer.querySelectorAll(".product");

		productElements.forEach((productEl) => {
			const numberInputs = productEl.querySelectorAll('input[type="number"]');
			numberInputs.forEach((input) => {
				input.value = 0;
			});
		});

		const returnBigInput = document.querySelector('input[name="return_big"]');
		const returnMediumInput = document.querySelector('input[name="return_medium"]');
		if (returnBigInput) returnBigInput.value = 0;
		if (returnMediumInput) returnMediumInput.value = 0;

		updateCart();
	}

	if (productsContainer) {
		document.querySelectorAll(".increase, .decrease").forEach((button) => {
			button.addEventListener("click", function () {
				const input = this.closest(".number-input").querySelector('input[type="number"]');
				if (!input) return;

				let value = parseInt(input.value) || 0;
				value = this.classList.contains("increase") ? value + 1 : Math.max(0, value - 1);
				input.value = value;

				updateCart();
			});
		});

		const clearButton = document.querySelector(".clear-cart");
		if (clearButton) {
			clearButton.addEventListener("click", clearCart);
		}

		const allNumberInputs = document.querySelectorAll('input[type="number"]');
		allNumberInputs.forEach((input) => {
			input.addEventListener("change", updateCart);
			input.addEventListener("input", updateCart);
		});

		updateCart();

		document.addEventListener(
			"wpcf7submit",
			function (e) {
				const form = e.target;
				const cartInput = form.querySelector('input[name="cart_data"]');
				if (cartInput) {
					const cartData = updateCart();
					cartInput.value = JSON.stringify(cartData);
				}
			},
			false
		);

		document.addEventListener("wpcf7mailsent", function (e) {
			clearCart(e);
		}, false);
	}
});

const navWp = document.querySelector("#menu-responsive");
const main = document.querySelector("main");
const menuIcon = document.querySelector(".header__navBar__menuIcon");
const selectLanguage = document.querySelector(".language-switcher");
const language = document.querySelector(".header__navBar__extra__language button");

function toggleMenu() {
	navWp.classList.toggle("active");

	if (navWp.classList.contains("active")) {
		document.body.style.overflow = "hidden";
	} else {
		document.body.style.overflow = "";
	}

	if (navWp.classList.contains("active")) {
		document.addEventListener("click", closeMenu);
	} else {
		document.removeEventListener("click", closeMenu);
	}
}

function closeMenu(e) {
	if (!navWp.contains(e.target) && !menuIcon.contains(e.target)) {
		toggleMenu();
	}
}

document.addEventListener("DOMContentLoaded", () => {
	menuIcon.addEventListener("click", toggleMenu);
});

function toggleLanguage() {
	selectLanguage.classList.toggle("select-language");

	if (selectLanguage.classList.contains("select-language")) {
		document.addEventListener("click", closeLanguage);
	} else {
		document.removeEventListener("click", closeLanguage);
	}
}

function closeLanguage(e) {
	if (!selectLanguage.contains(e.target) && !language.contains(e.target)) {
		toggleLanguage();
	}
}

document.addEventListener("DOMContentLoaded", () => {
	language.addEventListener("click", toggleLanguage);
});

document.addEventListener("DOMContentLoaded", () => {
	const order = document.querySelector(".neworder");

	function activateFromHash() {
		document.querySelectorAll(".expanded").forEach((el) => el.classList.remove("expanded"));
		const hash = window.location.hash;

		if (hash) {
			const el = document.querySelector(`${hash}`);

			if (el) {
				el.classList.add("expanded");
			}
		}
	}

	if (order) {
		activateFromHash();
		window.addEventListener("hashchange", activateFromHash);
	}
});
