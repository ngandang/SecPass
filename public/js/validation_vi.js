/*
 * Translated default messages for the jQuery validation plugin.
 * Locale: VI (Vietnamese; Tiếng Việt)
 */
$.extend( $.validator.messages, {
	required: "Vui lòng nhập trường này.",
	remote: "Vui lòng sửa lại trường này.",
	email: "Vui lòng nhập với định dạng email hợp lệ.",
	url: "Vui lòng nhập với định dạng URL hợp lệ.",
	strong: "Mật khẩu phải chứa ít nhất 8 ký tự bao gồm ít nhất:<br><ul><li>một ký tự hoa,</li><li>một ký tự thường,</li><li>một ký tự số,</li><li>một ký tự đăc biệt.</li></ul>",
	date: "Vui lòng nhập với định dạng ngày hợp lệ.",
	dateISO: "Vui lòng nhập ngày theo chuẩn ISO.",
	number: "Vui lòng chỉ nhập số.",
	digits: "Vui lòng nhập dạng chữ số.",
	creditcard: "Vui lòng nhập số thẻ tín dụng.",
	equalTo: "Hãy nhập thêm lần nữa.",
	extension: "Phần mở rộng không đúng.",
	maxlength: $.validator.format( "Hãy nhập từ {0} kí tự trở xuống." ),
	minlength: $.validator.format( "Hãy nhập từ {0} kí tự trở lên." ),
	rangelength: $.validator.format( "Hãy nhập từ {0} đến {1} kí tự." ),
	range: $.validator.format( "Hãy nhập từ {0} đến {1}." ),
	max: $.validator.format( "Hãy nhập từ {0} trở xuống." ),
	min: $.validator.format( "Hãy nhập từ {0} trở lên." )
} );