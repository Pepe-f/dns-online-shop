"use strict"

/*********************
 * Initialization file for vendor-free frontend app.js
 *********************/
var APP = window.APP || {}
APP.Dev = APP.Dev || {}
APP.Browser = APP.Browser || {}
APP.Plugins = APP.Plugins || {}
APP.Components = APP.Components || {} // force scroll to top on initial load

window.onbeforeunload = function () {
	window.scrollTo(0, 0)
} // shorthand operators

var _window = $(window)

var _document = $(document)

var easingSwing = [0.02, 0.01, 0.47, 1] // default jQuery easing

;(function ($, APP) {
	APP.Initilizer = function () {
		var app = {}

		app.init = function () {
			app.initGlobalPlugins()
			app.initPlugins()
			app.initComponents()
		}

		app.onLoadTrigger = function () {}

		app.refresh = function () {
			app.initPlugins(true)
			app.initComponents(true)
		}

		app.destroy = function () {} // pjax triggers

		app.newPageReady = function () {
			app.refresh()
		}

		app.transitionCompleted = function () {
			app.onLoadTrigger()
		} // Global plugins which must be initialized once

		app.initGlobalPlugins = function () {} // Plugins which depends on DOM and page content

		app.initPlugins = function (fromPjax) {} // All components from `src/componenets`

		app.initComponents = function (fromPjax) {
			APP.Components.Header.init(fromPjax)
			APP.Components.Banner.init()
			APP.Components.Catalog.init()
			APP.Components.Product.init()
			APP.Components.Cart.init()
			APP.Components.History.init()
			APP.Components.Profile.init()
			APP.Components.Modal.init()
			APP.Components.Ordering.init()
		}

		return app
	} // a.k.a. ready

	$(function () {
		APP.Initilizer().init()
	})
	$(window).on("load", function () {
		$.ready.then(function () {
			APP.Initilizer().onLoadTrigger()
		})
	})
})(jQuery, window.APP) //////////
// BANNER
//////////
;(function ($, APP) {
	APP.Components.Banner = {
		init: function init() {
			var bannerSlider = new Swiper(".banner-slider", {
				// Optional parameters
				loop: true,
				speed: 400,
				autoplay: {
					delay: 5000,
					disableOnInteraction: false,
					pauseOnMouseEnter: true,
				},
				// If we need pagination
				pagination: {
					el: ".swiper-pagination",
					clickable: true,
				},
				// Navigation arrows
				navigation: {
					nextEl: ".banner__button--next",
					prevEl: ".banner__button--prev",
				},
			})
		},
	}
})(jQuery, window.APP)
//////////
// CART
//////////
;(function ($, APP) {
	APP.Components.Cart = {
		init: function init() {
			function showCart(cart) {
				if ($("section").hasClass("cart")) {
					$(".breadcrumb").replaceWith("")
					$(".cart").replaceWith(cart)
				}
			}
			$("body").on("click", ".cart .counter-button", function () {
				var numberText = $(this).parent().find("span").text()
				var numberProducts = parseInt(numberText)

				if ($(this).hasClass("counter-button--minus")) {
					numberProducts--
				} else if ($(this).hasClass("counter-button--plus")) {
					numberProducts++
				}

				const id = $(this)
					.parent()
					.parent()
					.siblings(".cart-products__button")
					.data("product")

				if (numberProducts === 0) {
					$.ajax({
						url: "cart/delete",
						type: "GET",
						data: { id: id },
						success: function (res) {
							showCart(res)
							$.ajax({
								url: "cart/data",
								type: "GET",
								success: function (data) {
									const jsonData = JSON.parse(data)
									$(".cart-price").html(jsonData.sum + " руб")
									$(".cart-count").html(jsonData.qty)
									$(".button-cart__number").html(jsonData.qty)
								},
							})
						},
						error: function () {
							alert("Не удалось удалить товар из корзины")
						},
					})
				} else {
					$.ajax({
						url: "cart/qty",
						type: "GET",
						data: { id: id, qty: numberProducts },
						success: function (res) {
							showCart(res)
							$.ajax({
								url: "cart/data",
								type: "GET",
								success: function (data) {
									const jsonData = JSON.parse(data)
									$(".cart-price").html(jsonData.sum + " руб")
									$(".cart-count").html(jsonData.qty)
									$(".button-cart__number").html(jsonData.qty)
								},
							})
						},
						error: function () {
							alert("В наличии на складе меньше товаров")
						},
					})
				}
			})
		},
	}
})(jQuery, window.APP) //////////
// CATALOG
//////////
;(function ($, APP) {
	APP.Components.Catalog = {
		init: function init() {
			var minPrice = $(".catalog-filters__price--min").val()
			var maxPrice = $(".catalog-filters__price--max").val()
			$(".slider-range").slider({
				range: true,
				min: Number.parseInt($(".catalog-filters__price--min").attr("min")),
				max: Number.parseInt($(".catalog-filters__price--max").attr("max")),
				values: [
					Number.parseInt($(".catalog-filters__price--min").attr("min")),
					Number.parseInt($(".catalog-filters__price--max").attr("max")),
				],
				slide: function slide(event, ui) {
					$(".catalog-filters__price--min").val(ui.values[0])
					$(".catalog-filters__price--max").val(ui.values[1])
					minPrice = ui.values[0]
					maxPrice = ui.values[1]
				},
			})
			$(".catalog-filters__price").on("change", function () {
				var currentPrice = parseInt($(this).val())
				if (
					$(this).hasClass("catalog-filters__price--min") &&
					currentPrice <= maxPrice
				) {
					minPrice = currentPrice
				} else if (
					$(this).hasClass("catalog-filters__price--max") &&
					currentPrice >= minPrice
				) {
					maxPrice = currentPrice
				}
				$(".slider-range").slider("option", "values", [minPrice, maxPrice])
			})
			$(".catalog-filters__reset").on("click", function () {
				minPrice = Number.parseInt(
					$(".catalog-filters__price--min").attr("min")
				)
				maxPrice = Number.parseInt(
					$(".catalog-filters__price--max").attr("max")
				)
				$(".catalog-filters__checkbox").prop("checked", false)
				$(".catalog-filters__price--min").val(minPrice)
				$(".catalog-filters__price--max").val(maxPrice)
				$(".slider-range").slider("option", "values", [minPrice, maxPrice])

				const subcategoryId = Number.parseInt(
					$(".catalog").data("subcategory-id")
				)
				const catalogData = {
					subcategoryId: subcategoryId,
				}
				$.ajax({
					type: "POST",
					data: catalogData,
					url: "filtering.php",
					success: function (data) {
						$(".catalog-body").html(data)
					},
				})
			})
			$(".checkbox+label").on("click", function () {
				$(this)
					.siblings(".checkbox")
					.prop("checked", function (i, value) {
						return !value
					})
			})
			$(".catalog-filters__apply").on("click", function () {
				const brands = $("input[type='checkbox']:checked")
				const brandsId = []

				for (let i = 0; i < brands.length; i++) {
					brandsId.push(Number.parseInt($(brands[i]).data("brand-id")))
				}

				const subcategoryId = Number.parseInt(
					$(".catalog").data("subcategory-id")
				)

				const catalogData = {
					subcategoryId: subcategoryId,
					brandsId: brandsId,
					minPrice: minPrice,
					maxPrice: maxPrice,
				}

				$.ajax({
					type: "POST",
					data: catalogData,
					url: "filtering.php",
					success: function (data) {
						$(".catalog-body").html(data)
					},
				})
			})
			$(".radio+label").on("click", function () {
				if (!$(this).siblings(".radio").prop("checked")) {
					$(this)
						.siblings(".radio")
						.prop("checked", function (i, value) {
							return !value
						})
				}
			})
		},
	}
})(jQuery, window.APP) //////////
// HEADER
//////////
;(function ($, APP) {
	APP.Components.Header = {
		init: function init(fromPjax) {
			var windowWidth = $(window).width()

			$(window).on("resize", function () {
				windowWidth = $(this).width()
			})

			$(".header-bottom__catalog").click(function () {
				$(this).toggleClass("active")
				$(".header-bottom__catalog-body").toggleClass("active")
			})

			$(".header-bottom__catalog-item").hover(
				function () {
					$(this).find(".header-bottom__catalog-submenu").show()
				},
				function () {
					$(this).find(".header-bottom__catalog-submenu").hide()
				}
			)
		},
	}
})(jQuery, window.APP) //////////
// HISTORY
//////////
;(function ($, APP) {
	APP.Components.History = {
		init: function init() {
			$(".history-accordion__head").on("click", function () {
				if (!$(this).parent().hasClass("active")) {
					$(".history-accordion")
						.find(".history-accordion__item.active")
						.toggleClass("active")
						.find(".history-accordion__button")
						.toggleClass("active")
				}

				$(".history-accordion__body").not($(this).next()).slideUp(300)
				$(this).parent().find(".history-accordion__body").slideToggle(300)
				$(this).find(".history-accordion__button").toggleClass("active")
				$(this).parent().toggleClass("active")
			})
		},
	}
})(jQuery, window.APP) //////////
// MODAL
//////////
;(function ($, APP) {
	APP.Components.Modal = {
		init: function init() {
			$(document).ready(function () {
				$(".phone").mask("+7 (000) 000-00-00")

				const regForm = $(".modal-registration__form")

				regForm.validate({
					errorElement: "span",
					rules: {
						name: {
							minlength: 4,
						},
						email: {
							minlength: 4,
						},
						phone: {
							minlength: 18,
						},
						password: {
							minlength: 6,
						},
					},
					messages: {
						name: {
							required: "* Обязательно",
							minlength: "Некорректно",
						},
						email: {
							required: "* Обязательно",
							minlength: "Некорректно",
						},
						phone: {
							required: "* Обязательно",
							minlength: "Некорректно",
						},
						password: {
							required: "* Обязательно",
							minlength: "Мин. длина пароля - 6 символов",
						},
					},
				})

				regForm.on("submit", function (e) {
					e.preventDefault()

					if (regForm.valid()) {
						const formData = $(this).serialize()

						$.ajax({
							type: "POST",
							url: "user/signup",
							data: formData,
							success: function (response) {
								location.reload()
							},
							error: function (err) {
								alert(
									"Пользователь с таким номером телефона или почтой уже зарегистрирован"
								)
							},
						})
					}
				})

				const authForm = $(".modal-authorization__form")

				authForm.validate({
					errorElement: "span",
					rules: {
						email: {
							minlength: 4,
						},
						password: {
							minlength: 6,
						},
					},
					messages: {
						email: {
							required: "* Обязательно",
							minlength: "Некорректно",
						},
						password: {
							required: "* Обязательно",
							minlength: "Мин. длина пароля - 6 символов",
						},
					},
				})

				authForm.on("submit", function (e) {
					e.preventDefault()

					if (authForm.valid()) {
						const formData = authForm.serialize()

						$.ajax({
							type: "POST",
							url: "user/login",
							data: formData,
							success: function () {
								location.reload()
							},
							error: function (err) {
								alert("Неверные почта или пароль")
							},
						})
					}
				})
			})
		},
	}
})(jQuery, window.APP)
//////////
// PRODUCT
//////////
;(function ($, APP) {
	APP.Components.Product = {
		init: function init() {
			var productSlider = new Swiper(".product-images__slider", {
				loop: false,
				speed: 400,
				direction: "vertical",
				spaceBetween: 20,
				// autoHeight: true,
				breakpoints: {
					320: {
						slidesPerView: 3,
					},
					576: {
						slidesPerView: 4,
					},
				},
				navigation: {
					nextEl: ".product-images__slider-button",
				},
			})
			var mainProductSlider = new Swiper(".product-images__preview", {
				loop: false,
				speed: 400,
				effect: "fade",
			})
			$(".product-images__slide").on("click", function () {
				var activeSlide = $(this)
					.parent()
					.find(".product-images__slide--active")
				activeSlide.removeClass("product-images__slide--active")
				$(this).addClass("product-images__slide--active")
				var activeIndex = productSlider.clickedIndex
				mainProductSlider.slideTo(activeIndex, 200)
			})
			mainProductSlider.on("slideChange", function () {
				var activeIndex = mainProductSlider.activeIndex
				productSlider.slideTo(activeIndex, 200)
				$(".product-images__slider")
					.find(".product-images__slide--active")
					.removeClass("product-images__slide--active")
				var productSlide = productSlider.slides[activeIndex]
				$(productSlide).addClass("product-images__slide--active")
			})
			$(".button-cart").on("click", function () {
				$(this).toggleClass("active")

				if ($(this).parent().hasClass("product-characteristics__actions")) {
					var productsCounter = $(this)
						.parent()
						.find(".product-characteristics__count")
					var numberProducts = parseInt(productsCounter.find("span").text())
					$(this).find(".button-cart__number").text(numberProducts)
				}
			})
			$(".favorite-button").on("click", function () {
				$(this).toggleClass("active")
			})
		},
	}
})(jQuery, window.APP)
//////////
// PROFILE
//////////

$(function () {
	function showCart(cart) {
		if ($("section").hasClass("cart")) {
			$(".breadcrumb").replaceWith("")
			$(".cart").replaceWith(cart)
		}
	}
	$(".button-cart").on("click", function (e) {
		e.preventDefault()

		const id = $(this).data("product")
		const qty = 1

		if ($(this).hasClass("active")) {
			$.ajax({
				url: "cart/add",
				type: "GET",
				data: { id: id, qty: qty },
				success: function (res) {
					showCart(res)
					$.ajax({
						url: "cart/data",
						type: "GET",
						success: function (data) {
							const jsonData = JSON.parse(data)
							$(".cart-price").html(jsonData.sum + " руб")
							$(".cart-count").html(jsonData.qty)
							$(".button-cart__number").html(jsonData.qty)
						},
					})
				},
				error: function () {
					alert("Не удалось добавить товар в корзину")
				},
			})
		} else {
			$.ajax({
				url: "cart/delete",
				type: "GET",
				data: { id: id },
				success: function (res) {
					showCart(res)
					$.ajax({
						url: "cart/data",
						type: "GET",
						success: function (data) {
							const jsonData = JSON.parse(data)
							$(".cart-price").html(jsonData.sum + " руб")
							$(".cart-count").html(jsonData.qty)
							$(".button-cart__number").html(jsonData.qty)
						},
					})
				},
				error: function () {
					alert("Не удалось удалить товар из корзины")
				},
			})
		}
	})

	$(".cart").on("click", ".cart-products__button", function () {
		const id = $(this).data("product")

		$.ajax({
			url: "cart/delete",
			type: "GET",
			data: { id: id },
			success: function (res) {
				showCart(res)
				$.ajax({
					url: "cart/data",
					type: "GET",
					success: function (data) {
						const jsonData = JSON.parse(data)
						$(".cart-price").html(jsonData.sum + " руб")
						$(".cart-count").html(jsonData.qty)
						$(".button-cart__number").html(jsonData.qty)
					},
				})
			},
			error: function () {
				alert("Не удалось удалить товар из корзины")
			},
		})
	})
})
;(function ($, APP) {
	APP.Components.Profile = {
		init: function init() {
			$(document).ready(function () {
				$(".phone").mask("+7 (000) 000-00-00")

				const profileForm = $(".profile-data__form-data")

				profileForm.validate({
					errorElement: "span",
					rules: {
						name: {
							minlength: 4,
						},
						email: {
							minlength: 4,
						},
						phone: {
							minlength: 18,
						},
						location: {
							minlength: 3,
						},
					},
					messages: {
						name: {
							required: "* Обязательно",
							minlength: "Некорректно",
						},
						email: {
							required: "* Обязательно",
							minlength: "Некорректно",
						},
						phone: {
							required: "* Обязательно",
							minlength: "Некорректно",
						},
						location: {
							required: "* Обязательно",
							minlength: "Некорректно",
						},
					},
				})

				profileForm.on("submit", function (e) {
					e.preventDefault()

					if (profileForm.valid()) {
						const formData = $(this).serialize()

						$.ajax({
							type: "POST",
							url: "user/change",
							data: formData,
							success: function () {
								location.reload()
							},
							error: function (err) {
								alert("Произошла ошибка изменения данных")
							},
						})
					}
				})

				const passForm = $(".profile-data__form-pass")

				passForm.validate({
					errorElement: "span",
					rules: {
						password: {
							minlength: 6,
						},
						password_2: {
							minlength: 6,
						},
					},
					messages: {
						password: {
							required: "* Обязательно",
							minlength: "Мин длина 6 символов",
						},
						password_2: {
							required: "* Обязательно",
							minlength: "Мин длина 6 символов",
						},
					},
				})

				passForm.on("submit", function (e) {
					e.preventDefault()

					if (
						$("input[name='password']").val() ===
						$("input[name='password_2']").val()
					) {
						if (passForm.valid()) {
							const formData = $(this).serialize()

							$.ajax({
								type: "POST",
								url: "user/password",
								data: formData,
								success: function (response) {
									alert("Пароль успешно изменен")
									setTimeout(() => {
										location.reload()
									}, 2000)
								},
							})
						}
					} else {
						alert("Пароли в полях не совпадают")
					}
				})
			})
		},
	}
})(jQuery, window.APP)
;(function ($, APP) {
	APP.Components.Ordering = {
		init: function init() {
			$(document).ready(function () {
				$(".phone").mask("+7 (000) 000-00-00")

				const orderingForm = $(".ordering-form")

				orderingForm.on("submit", function (e) {
					e.preventDefault()

					if (orderingForm.valid()) {
						const formData = $(this).serializeArray()

						$.ajax({
							type: "POST",
							url: "cart/checkout",
							data: formData,
							success: function (response) {
								window.location.href = "cart/success"
							},
							error: function (err) {
								alert(
									"Произошла непредвиденная ошибка оформления заказа, повторите еще раз"
								)
							},
						})
					}
				})
			})
		},
	}
})(jQuery, window.APP)
