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
        #style("Istyle")
    ]),
    body(null,[#replace null for OloadDoc() in case you need it
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
                cls(div("Imessages Sdisplay:_none;",p())),
                cls(div("Sdisplay:_none; IbookForm",[
                    "<hr/>",
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
                ]))
            ])
        ]),
        footer(null,"FOOTER"),
        #script(null,changeContentOf("style","styles.php")),
        script("Shttps://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js Isha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf Canonymous")
    ])
]);
