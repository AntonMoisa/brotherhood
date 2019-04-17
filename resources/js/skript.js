$(document).ready(function() {
  let showForm = $('.builders__join-btn');
  let closeForm = $('.join__form-close');
  let form = $('.builders__join');
  let quotes = $('.builders__quotes');
  
  showForm.on('click', function() {
    quotes.toggleClass('active');
    form.toggleClass('active');
  })

  closeForm.on('click', function() {
    quotes.toggleClass('active');
    form.toggleClass('active');
  })

  $('.languages-form select').change(function () {
    let changeLanguage = '/setlocale/' + $('.languages-form select').val();
    $('.languages-form').attr('action', changeLanguage).submit();
  })
});
