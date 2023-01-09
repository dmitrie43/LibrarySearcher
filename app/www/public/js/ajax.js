function getContentBookByGenre(book) {
    let content = '<div class="slick-slide slick-current slick-active" data-slick-index="0" aria-hidden="false">' +
                '<div>' +
                    '<div class="creators" style="width: 100%; display: inline-block;">' +
                        '<div class="creatorImg">' +
                            '<img class="img-fluid" src="'+ book.cover_img +'" alt="img">' +
                        '</div>';
    if (Object.keys(book.author).length > 0) {
        if (book.author.photo !== null) {
            content += '<div class="creatorIcon">' +
                            '<img class="img-fluid" src="'+ book.author.photo +'" alt="">' +
                            '<div class="creatorcheck"><img src="/img/checkicon.svg" alt="img"></div>' +
                        '</div>';
        }
        content += '<div class="creatorsText text-center">' +
                        '<h2 class="textwhitecolor">'+ book.author.full_name +'</h2>' +
                        '<h3 class="textbluecolor">Великий писатель</h3>' +
                        '<p class="textgraycolor">Создал множество жанров и направлений</p>' +
                    '</div>';
    }
    content += '</div></div></div>';
    return content;
}

function getBooksByGenre(genre_id) {
    $.ajax({
        url: "/api/book/get", // указываем URL
        method: "GET",            // HTTP метод, по умолчанию GET
        data: {"genre": genre_id},         // данные, которые отправляем на сервер
        dataType: "json",         // тип данных загружаемых с сервера
        success: function (data) {
            let content = '<div class="slick-list draggable"><div class="slick-track" style="opacity: 1; width: 10000px; transform: translate3d(0px, 0px, 0px);">';
            $.each(data['data']['books'], function(index, book){
                content += getContentBookByGenre(book);
            });
            content += '</div></div>';
            document.getElementById('books-by-genre').innerHTML = content;
        }
    });
}

function getBooks() {
    $.ajax({
        url: "/api/book/get", // указываем URL
        method: "GET",            // HTTP метод, по умолчанию GET
        data: {},         // данные, которые отправляем на сервер
        dataType: "json",         // тип данных загружаемых с сервера
        success: function (data) {
            let content = '<div class="slick-list draggable"><div class="slick-track" style="opacity: 1; width: 10000px; transform: translate3d(0px, 0px, 0px);">';
            $.each(data['data']['books'], function(index, book){
                content += getContentBookByGenre(book);
            });
            content += '</div></div>';
            document.getElementById('books-by-genre').innerHTML = content;
        }
    });
}
