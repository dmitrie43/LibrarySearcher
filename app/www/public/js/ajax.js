function getContentBookByGenre(book) {
    let content =   '<div class="creators">' +
                        '<a href="/books/'+ book.id +'">' +
                        '<div class="creatorImg">' +
                            '<img class="img-fluid" src="'+ book.cover_img +'" alt="img">' +
                        '</div>';
    if (Object.keys(book.author).length > 0) {
        content += '<div class="creatorsText text-center">' +
                        '<h2 class="textwhitecolor">'+ book.name +'</h2>' +
                        '<h3 class="textbluecolor">'+ book.author.full_name +'</h3>' +
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
                    arrows:false,
                    dots: true
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows:false,
                    dots: true
                }
            }

        ]
    });
}

function getBooksByGenre(genre_id) {
    $.ajax({
        url: "/api/books",
        method: "GET",
        data: {"genre_id[]": genre_id},
        dataType: "json",
        success: function (data) {
            let content = '';
            let popular = $('.popular');
            popular.slick('unslick');
            $.each(data['books'], function(index, book){
                content += getContentBookByGenre(book);
            });
            document.getElementById('books-by-genre').innerHTML = content;
            setSlick('popular');
        }
    });
}

function getBooks() {
    $.ajax({
        url: "/api/books",
        method: "GET",
        data: {},
        dataType: "json",
        success: function (data) {
            let content = '';
            let popular = $('.popular');
            popular.slick('unslick');
            $.each(data['books'], function(index, book){
                content += getContentBookByGenre(book);
            });
            document.getElementById('books-by-genre').innerHTML = content;
            setSlick('popular');
        }
    });
}
