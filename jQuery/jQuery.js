// скрыть заголовок через 3 секунды
// $("h1").hide(3000);

// ждем загруку документа ready потом получаем кномку по тегу button вешаем клик click потом получаем h1 и скрываем hide его при клике на кнопку через 3 секунды
// $(document).ready(function (){
//     $("button").on("click", function (){
//         $("h1").hide(3000);
//     });
// });

// $(document).ready(function (){
//     //$("h2").css("background-color", "red");
//     //$(".header").css("background-color", "blue");
//     $("#countries").css("background-color", "orange");
// })
// Обрабатываем переключение чекбокса
// $(document).ready(function (){
//     $('#flexCheckDefault').change(function () {
//         // Определяем, установлен ли чекбокс
//         let is_true = $(this).is(':checked') ? 1 : 0;
//
//         // Загружаем пользователей в зависимости от состояния чекбокса
//         if (is_true) {
//             $("h1").hide(3000); // Скрываем заголовок
//         } else {
//             $("h1").show(3000); // Показываем заголовок
//         }
//     });
// });