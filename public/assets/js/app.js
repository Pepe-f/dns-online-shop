'use strict'

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
	$(window).on('load', function () {
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
			var bannerSlider = new Swiper('.banner-slider', {
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
					el: '.swiper-pagination',
					clickable: true,
				},
				// Navigation arrows
				navigation: {
					nextEl: '.banner__button--next',
					prevEl: '.banner__button--prev',
				},
			})
		},
	}
})(jQuery, window.APP) //////////
// CART
//////////
function updateCartInterface() {
	$.post('app/interface/cart-interface.php', {}, data => {
		$('.cart').html(data)
	})
}
;(function ($, APP) {
	APP.Components.Cart = {
		init: function init() {
			$('.cart').on('click', '.counter-button', function () {
				var numberText = $(this).parent().find('span').text()
				var numberProducts = parseInt(numberText)

				if ($(this).hasClass('counter-button--minus') && numberProducts > 1) {
					numberProducts--
				} else if ($(this).hasClass('counter-button--plus')) {
					numberProducts++
				}

				let id = $(this)
					.parent()
					.parent()
					.siblings('.cart-products__button')
					.data('product')

				$.post(
					'app/controllers/cart.php',
					{ cart: 'qty', id: id, qty: numberProducts },
					data => {
						const jsonData = JSON.parse(data)
						$('.cart-price').html(jsonData.price + ' руб')
						$('.cart-count').html(jsonData.count)
						$('.button-cart__number').html(jsonData.count)

						updateCartInterface()
					}
				)
			})
		},
	}
})(jQuery, window.APP) //////////
// CATALOG
//////////
;(function ($, APP) {
	APP.Components.Catalog = {
		init: function init() {
			var minPrice = $('.catalog-filters__price--min').val()
			var maxPrice = $('.catalog-filters__price--max').val()
			$('.slider-range').slider({
				range: true,
				min: Number.parseInt($('.catalog-filters__price--min').attr('min')),
				max: Number.parseInt($('.catalog-filters__price--max').attr('max')),
				values: [
					Number.parseInt($('.catalog-filters__price--min').attr('min')),
					Number.parseInt($('.catalog-filters__price--max').attr('max')),
				],
				slide: function slide(event, ui) {
					$('.catalog-filters__price--min').val(ui.values[0])
					$('.catalog-filters__price--max').val(ui.values[1])
					minPrice = ui.values[0]
					maxPrice = ui.values[1]
				},
			})
			$('.catalog-filters__price').on('change', function () {
				var currentPrice = parseInt($(this).val())
				if (
					$(this).hasClass('catalog-filters__price--min') &&
					currentPrice <= maxPrice
				) {
					minPrice = currentPrice
				} else if (
					$(this).hasClass('catalog-filters__price--max') &&
					currentPrice >= minPrice
				) {
					maxPrice = currentPrice
				}
				$('.slider-range').slider('option', 'values', [minPrice, maxPrice])
			})
			$('.catalog-filters__reset').on('click', function () {
				minPrice = Number.parseInt(
					$('.catalog-filters__price--min').attr('min')
				)
				maxPrice = Number.parseInt(
					$('.catalog-filters__price--max').attr('max')
				)
				$('.catalog-filters__checkbox').prop('checked', false)
				$('.catalog-filters__price--min').val(minPrice)
				$('.catalog-filters__price--max').val(maxPrice)
				$('.slider-range').slider('option', 'values', [minPrice, maxPrice])

				const subcategoryId = Number.parseInt(
					$('.catalog').data('subcategory-id')
				)
				const catalogData = {
					subcategoryId: subcategoryId,
				}
				$.ajax({
					type: 'POST',
					data: catalogData,
					url: 'filtering.php',
					success: function (data) {
						$('.catalog-body').html(data)
					},
				})
			})
			$('.checkbox+label').on('click', function () {
				$(this)
					.siblings('.checkbox')
					.prop('checked', function (i, value) {
						return !value
					})
			})
			$('.catalog-filters__apply').on('click', function () {
				const brands = $("input[type='checkbox']:checked")
				const brandsId = []

				for (let i = 0; i < brands.length; i++) {
					brandsId.push(Number.parseInt($(brands[i]).data('brand-id')))
				}

				const subcategoryId = Number.parseInt(
					$('.catalog').data('subcategory-id')
				)

				const catalogData = {
					subcategoryId: subcategoryId,
					brandsId: brandsId,
					minPrice: minPrice,
					maxPrice: maxPrice,
				}

				$.ajax({
					type: 'POST',
					data: catalogData,
					url: 'filtering.php',
					success: function (data) {
						$('.catalog-body').html(data)
					},
				})
			})
			$('.radio+label').on('click', function () {
				if (!$(this).siblings('.radio').prop('checked')) {
					$(this)
						.siblings('.radio')
						.prop('checked', function (i, value) {
							return !value
						})
				}
			})
			var blurText = $('.catalog-description__text--blur')
			var hiddenText = $('.catalog-description__text--hidden')
			$('.catalog-description__button').on('click', function () {
				if ($(this).hasClass('catalog-description__button--hide')) {
					$(this).text('Читать подробнее')
				} else {
					$(this).text('Скрыть')
				}
				blurText.toggleClass('catalog-description__text--blur')
				hiddenText.toggleClass('catalog-description__text--hidden')
				$(this).toggleClass('catalog-description__button--hide')
			})
			$('.catalog-filters__button').on('click', function () {
				$(this).toggleClass('catalog-filters__button--active')
				if ($(this).hasClass('catalog-filters__button--active')) {
					$(this).find('span').text('Скрыть фильтры')
				} else {
					$(this).find('span').text('Показать фильтры')
				}
				$('.catalog-filters').toggleClass('filters-active')
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
			$(window).on('resize', function () {
				windowWidth = $(this).width()
			})
			$('.header-bottom__catalog').on('click', function () {
				$('.catalog-menu').addClass('active')
				$('body').css('overflow-y', 'hidden')
			})
			$('.catalog-menu__button').on('click', function () {
				$('.catalog-menu').removeClass('active')
				$('body').css('overflow-y', 'auto')
			})
			$('.catalog-menu__category-item').on('mouseenter', function () {
				if (windowWidth >= 992) {
					$('.catalog-menu__category-link')
						.removeClass('catalog-menu__category-link--enter')
						.hasClass('catalog-menu__category-link--enter')
					$(this)
						.find('.catalog-menu__category-link')
						.addClass('catalog-menu__category-link--enter')
					var categoryName = $(this).find('.catalog-menu__category-link').text()
					var catalogList = $('.catalog-menu__subtitle')

					for (var i = 0; i < catalogList.length; i++) {
						if ($(catalogList[i]).text() === categoryName) {
							$('.catalog-menu__container')
								.removeClass('catalog-menu__container--visible')
								.hasClass('catalog-menu__container--visible')
							$(catalogList[i])
								.parent()
								.addClass('catalog-menu__container--visible')
						}
					}
				}
			})

			$('.catalog-menu__category-item').on('click', function () {
				if (windowWidth < 992) {
					var categoryName = $(this).find('.catalog-menu__category-link').text()
					var catalogList = $('.catalog-menu__subtitle')

					for (var i = 0; i < catalogList.length; i++) {
						if ($(catalogList[i]).text() === categoryName) {
							$('.catalog-menu__left').hide()
							$('.catalog-menu__container')
								.removeClass('catalog-menu__container--visible')
								.hasClass('catalog-menu__container--visible')
							$(catalogList[i])
								.parent()
								.addClass('catalog-menu__container--visible')
						}
					}
				}
			})
			$('.catalog-menu__back').on('click', function () {
				$('.catalog-menu__left').show()
			})
			let $result = $('#search_box-result')

			$('#search').on('keyup', function () {
				let search = $(this).val()
				if (search !== '' && search.length > 1) {
					$.ajax({
						type: 'POST',
						url: 'search.php',
						data: { search: search },
						success: function (response) {
							$result.html(response)
							if (response !== '') {
								$result.fadeIn()
							} else {
								$result.fadeOut(100)
							}
						},
					})
				} else {
					$result.html('')
					$result.fadeOut(100)
				}
			})
			$(document).on('click', function (e) {
				if (!$(e.target).closest('.search_box').length) {
					$result.html('')
					$result.fadeOut(100)
				}
			})
		},
	}
})(jQuery, window.APP) //////////
// HISTORY
//////////
;(function ($, APP) {
	APP.Components.History = {
		init: function init() {
			$('.history-accordion__head').on('click', function () {
				if (!$(this).parent().hasClass('active')) {
					$('.history-accordion')
						.find('.history-accordion__item.active')
						.toggleClass('active')
						.find('.history-accordion__button')
						.toggleClass('active')
				}

				$('.history-accordion__body').not($(this).next()).slideUp(300)
				$(this).parent().find('.history-accordion__body').slideToggle(300)
				$(this).find('.history-accordion__button').toggleClass('active')
				$(this).parent().toggleClass('active')
			})
		},
	}
})(jQuery, window.APP) //////////
// MODAL
//////////
;(function ($, APP) {
	APP.Components.Modal = {
		init: function init() {
			$('.modal-change__variant').on('click', function () {
				var location = $(this).text()
				$('.header-top__location-link').find('span').text(location)
				$('#location-change').modal('toggle')
			})

			$(document).ready(function () {
				$('.phone').mask('+7 (000) 000-00-00')

				const regForm = $('.modal-registration__form')

				regForm.validate({
					errorElement: 'span',
					rules: {
						reg_name: {
							minlength: 4,
						},
						reg_mail: {
							minlength: 4,
						},
						reg_phone: {
							minlength: 18,
						},
						reg_password: {
							minlength: 6,
						},
					},
					messages: {
						reg_name: {
							required: '* Обязательно',
							minlength: 'Некорректно',
						},
						reg_mail: {
							required: '* Обязательно',
							minlength: 'Некорректно',
						},
						reg_phone: {
							required: '* Обязательно',
							minlength: 'Некорректно',
						},
						reg_password: {
							required: '* Обязательно',
							minlength: 'Мин. длина пароля - 6 символов',
						},
					},
				})

				regForm.on('submit', function (e) {
					e.preventDefault()

					if (regForm.valid()) {
						const formData = $(this).serialize()

						$.ajax({
							type: 'POST',
							url: 'reg.php',
							data: formData,
							success: function (response) {
								if (!response || response === '') {
									location.reload()
								} else {
									alert(response)
								}
							},
						})
						$('.modal-registration').modal('toggle')
					}
				})

				const authForm = $('.modal-authorization__form')

				authForm.validate({
					errorElement: 'span',
					rules: {
						auth_mail: {
							minlength: 4,
						},
						auth_password: {
							minlength: 6,
						},
					},
					messages: {
						auth_mail: {
							required: '* Обязательно',
							minlength: 'Некорректно',
						},
						auth_password: {
							required: '* Обязательно',
							minlength: 'Мин. длина пароля - 6 символов',
						},
					},
				})

				authForm.on('submit', function (e) {
					e.preventDefault()

					if (authForm.valid()) {
						const formData = authForm.serialize()

						$.ajax({
							type: 'POST',
							url: 'auth.php',
							data: formData,
							success: function () {
								location.reload()
							},
						})

						$('.modal-authorization').modal('toggle')
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
			var productSlider = new Swiper('.product-images__slider', {
				loop: false,
				speed: 400,
				direction: 'vertical',
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
					nextEl: '.product-images__slider-button',
				},
			})
			var mainProductSlider = new Swiper('.product-images__preview', {
				loop: false,
				speed: 400,
				effect: 'fade',
			})
			$('.product-images__slide').on('click', function () {
				var activeSlide = $(this)
					.parent()
					.find('.product-images__slide--active')
				activeSlide.removeClass('product-images__slide--active')
				$(this).addClass('product-images__slide--active')
				var activeIndex = productSlider.clickedIndex
				mainProductSlider.slideTo(activeIndex, 200)
			})
			mainProductSlider.on('slideChange', function () {
				var activeIndex = mainProductSlider.activeIndex
				productSlider.slideTo(activeIndex, 200)
				$('.product-images__slider')
					.find('.product-images__slide--active')
					.removeClass('product-images__slide--active')
				var productSlide = productSlider.slides[activeIndex]
				$(productSlide).addClass('product-images__slide--active')
			})
			$('.button-cart').on('click', function () {
				$(this).toggleClass('active')

				if ($(this).parent().hasClass('product-characteristics__actions')) {
					var productsCounter = $(this)
						.parent()
						.find('.product-characteristics__count')
					var numberProducts = parseInt(productsCounter.find('span').text())
					$(this).find('.button-cart__number').text(numberProducts)
				}
			})
			$('.favorite-button').on('click', function () {
				$(this).toggleClass('active')
			})
		},
	}
})(jQuery, window.APP)
//////////
// PROFILE
//////////

$(function () {
	$('.button-cart').on('click', function () {
		let id = $(this).data('product')

		if ($(this).hasClass('active')) {
			$.post('/app/controllers/cart.php', { cart: 'add', id: id }, data => {
				const jsonData = JSON.parse(data)

				$('.cart-price').html(jsonData.price + ' руб')
				$('.cart-count').html(jsonData.count)
				$('.button-cart__number').html(jsonData.count)

				if ($('section').hasClass('cart')) {
					updateCartInterface()
				}
			})
		} else {
			$.post('/app/controllers/cart.php', { cart: 'remove', id: id }, data => {
				const jsonData = JSON.parse(data)

				$('.cart-price').html(jsonData.price + ' руб')
				$('.cart-count').html(jsonData.count)
				$('.button-cart__number').html(jsonData.count)

				if ($('section').hasClass('cart')) {
					updateCartInterface()
				}
			})
		}
	})

	$('.cart').on('click', '.cart-products__button', function () {
		let id = $(this).data('product')

		$.post('/app/controllers/cart.php', { cart: 'remove', id: id }, data => {
			const jsonData = JSON.parse(data)

			$('.cart-price').html(jsonData.price + ' руб')
			$('.cart-count').html(jsonData.count)
			$('.button-cart__number').html(jsonData.count)
			$(".button-cart[data-product='" + id + "']").removeClass('active')

			updateCartInterface()
		})
	})
})
;(function ($, APP) {
	APP.Components.Profile = {
		init: function init() {
			$(document).ready(function () {
				$('.phone').mask('+7 (000) 000-00-00')

				const profileForm = $('.profile-data__form-data')

				profileForm.validate({
					errorElement: 'span',
					rules: {
						update_fullname: {
							minlength: 4,
						},
						update_email: {
							minlength: 4,
						},
						update_phone: {
							minlength: 18,
						},
						update_location: {
							minlength: 3,
						},
					},
					messages: {
						update_fullname: {
							required: '* Обязательно',
							minlength: 'Некорректно',
						},
						update_email: {
							required: '* Обязательно',
							minlength: 'Некорректно',
						},
						update_phone: {
							required: '* Обязательно',
							minlength: 'Некорректно',
						},
						update_location: {
							required: '* Обязательно',
							minlength: 'Некорректно',
						},
					},
				})

				profileForm.on('submit', function (e) {
					e.preventDefault()

					if (profileForm.valid()) {
						const formData = $(this).serialize()

						$.ajax({
							type: 'POST',
							url: 'updateUser.php',
							data: formData,
							success: function () {
								location.reload()
							},
						})
					}
				})

				const passForm = $('.profile-data__form-pass')

				passForm.validate({
					errorElement: 'span',
					rules: {
						newpass_1: {
							minlength: 6,
						},
						newpass_2: {
							minlength: 6,
						},
					},
					messages: {
						newpass_1: {
							required: '* Обязательно',
							minlength: 'Мин длина 6 символов',
						},
						newpass_2: {
							required: '* Обязательно',
							minlength: 'Мин длина 6 символов',
						},
					},
				})

				passForm.on('submit', function (e) {
					e.preventDefault()

					if ($('input'))
						if (passForm.valid()) {
							const formData = $(this).serialize()

							$.ajax({
								type: 'POST',
								url: 'updateUser.php',
								data: formData,
								success: function (response) {
									$('.response').find('div').html(response)
								},
							})
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
				$('.phone').mask('+7 (000) 000-00-00')

				const orderingForm = $('.ordering-form')

				orderingForm.on('submit', function (e) {
					e.preventDefault()

					if (orderingForm.valid()) {
						const formData = $(this).serializeArray()

						$.ajax({
							type: 'POST',
							url: '/orderCreate.php',
							data: formData,
							success: function (response) {
								window.location = response
							},
						})
					}
				})
			})
		},
	}
})(jQuery, window.APP)
