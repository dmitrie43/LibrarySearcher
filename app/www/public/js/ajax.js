function getContentBookByGenre(book) {
    let content = '<div class="creators">' +
        '<a href="/books/' + book.id + '">' +
        '<div class="creatorImg">' +
        '<img class="img-fluid" src="' + book.cover_img + '" alt="img">' +
        '</div>';
    if (Object.keys(book.author).length > 0) {
        if (book.author.photo !== null) {
            content += '<div class="creatorIcon">' +
                '<img class="img-fluid" src="' + book.author.photo + '" alt="">' +
                '<div class="creatorcheck"><img src="/img/checkicon.svg" alt="img"></div>' +
                '</div>';
        }
        content += '<div class="creatorsText text-center">' +
            '<h2 class="textwhitecolor">' + book.name + '</h2>' +
            '<h3 class="textbluecolor">' + book.author.full_name + '</h3>' +
            '</div>';
    }
    content += '</a></div>';
    return content;
}

function setSlick(class_name) {
    $('.' + class_name).slick({
        dots: false,
        arrows: true,
        infinite: true,
        speed: 300,
        slidesToShow: 3,
        slidesToScroll: 1,
        variableWidth: true,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    infinite: true,
                    arrows: false,
                    dots: true
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false,
                    dots: true
                }
            }

        ]
    });
}

function set_favorite(book_id) {
    $.ajax({
        url: "/books/set_favorite",
        method: "POST",
        data: {"book_id": book_id},
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            let src = '/img/wishlist-1.png';
            if (data.is_favorite) {
                src = '/img/wishlist-2.png';
            }
            $('#wishlist-img').attr('src', src);
            $('#')
        }
    });
}

function getBooksByGenre(genre_id) {
    $.ajax({
        url: "/api/book/get", // указываем URL
        method: "GET",            // HTTP метод, по умолчанию GET
        data: {"genre": genre_id},         // данные, которые отправляем на сервер
        dataType: "json",         // тип данных загружаемых с сервера
        success: function (data) {
            let content = '';
            let popular = $('.popular');
            popular.slick('unslick');
            $.each(data['data']['books'], function (index, book) {
                content += getContentBookByGenre(book);
            });
            document.getElementById('books-by-genre').innerHTML = content;
            setSlick('popular');
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
            let content = '';
            let popular = $('.popular');
            popular.slick('unslick');
            $.each(data['data']['books'], function (index, book) {
                content += getContentBookByGenre(book);
            });
            document.getElementById('books-by-genre').innerHTML = content;
            setSlick('popular');
        }
    });
}
