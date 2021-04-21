<?php

require_once __DIR__ . "/vendor/autoload.php";

doctype();
html("Les",[
    head(null,[
        meta("CUTF-8"),
        cls(meta("Nviewport cwidth=device-width,_initial-scale=1.0")),
        //replace the url , with your fonts
        lk("Hhttps://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Inter:wght@300;500&display=swap Rstylesheet"),
        //replace the path word with your favicon url
        cls(lk("Rshortcut_icon Hpath")),
        title(null,"API REST"),
        style("Istyle")
    ]),
    body("OloadDoc()",[
        hdr(),
        main(),
        footer(),
        script(null,changeContentOf("style","styles.php"))
    ])
]);
