<?php

require_once __DIR__ . "/vendor/autoload.php";

doctype();
html("Les",[
    head(null,[
        meta("CUTF-8"),
        cls(meta("Nviewport cwidth=device-width,_initial-scale=1.0")),
        //replace the url , with your fonts
        lk("Hhttps://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Inter:wght@300;500&display=swap Rstylesheet"),
        lk("Hhttps://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css Rstylesheet Isha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6 Canonymous"),
        //replace the path word with your favicon url
        cls(lk("Rshortcut_icon Hpath")),
        title(null,"API REST"),
        style("Istyle")
    ]),
    body("OloadDoc()",[#replace null for OloadDoc() in case you need it
        hdr(null,"API REST EXAMPLE"),
        main(null,[
            table("IbooksTable Ctable",[
                thead(null,[
                    tr(null,[
                        th(null,"Titulo"),
                        th(null,"Id_Autor"),
                        th(null,"Id_Genero")
                    ])
                ]),
                tbody(),
                cls(input("Tbutton VCargar_libros IloadBooks")),
                div("Imessages",p()),
                div("IbookForm",[
                    hr(),
                    table(null,[
                        tr(null,[
                            td(null,"Titulo:"),
                            td(null,cls(input("Ttext NbookTitle IbookTitle Pbook_title")))
                        ]),
                        tr(null,[
                            td(null,"Id Autor:"),
                            td(null,cls(input("Ttext NbookAutorId IbookAutorId Pbook_autor_id")))
                        ]),
                        tr(null,[
                            td(null,"Id Genero:"),
                            td(null,cls(input("Ttext NbookGeneroId IbookGeneroId Pbook_genero_id")))
                        ]),
                        tr(null,[
                            td("C2",input("Tbutton VGuardar IbookSave"))
                        ])
                    ])
                ])
            ])
        ]),
        footer(null,"FOOTER"),
        script(null,changeContentOf("style","styles.php")),
        script("Shttps://code.jquery.com/jquery-3.6.0.min.js Isha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4= Canonymous"/*,changeContentOf("style","styles.php")*/),
        script("Shttps://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js Isha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf Canonymous"),
        script("Ttext/javascript",[
            "$('#loadBooks').click(function(){
                $('#messages').first('p').text('Cargando libros...');
                $('#messages').show();
                $.ajax(
                    {
                        'url': 'http://localhost:8000/books',
                        'success': function(data){
                            $('#messages').hide();
                            $('#booksTable > tbody').empty();
                            for(b in data){
                                addBook(data[b]);
                            }
                            $('#bookForm').show();
                        }
                    }
                );
            });",
            "function addBook(book){
                $('#booksTable tr:last').after('<tr><td>' + book.titulo + '</td><td>' + book.id_autor + '</td><td>' + book.id_genero + '</td></tr>');
            }",
            "$('#bookSave').click(function() {
                var newBook = {
                    'titulo': $('#bookTitle').val(),
                    'id_autor': $('#bookAutorId').val(),
                    'id_genero': $('#bookGeneroId').val()
                }
                $('#messages').first('p').text('Guardando libro...');
                $('#messages').show();
                $.ajax({
                    'url': window.location.href + (window.location.href.substr(window.location.href.lenght - 1) == '/' ? '' : '/') + 'books',
                    'method': 'POST',
                    'data': JSON.stringify(newBook),
                    'success': function(data){
                        $('#messages').hide();
                        addBook(newBook);
                    }
                });
            });"
        ])
    ])
]);
