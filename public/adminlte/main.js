$(function () {
	$(".delete").click(function () {
		let res = confirm("Подтвердите действие")
		if (!res) return false
	})

	$(".card-body").on("click", ".del-img", function () {
		const parentDiv = $(this).closest(".product-img-upload").remove()
		return false
	})

	bsCustomFileInput.init()
})
