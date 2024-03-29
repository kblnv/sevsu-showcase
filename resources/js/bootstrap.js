import htmx from "htmx.org";
import Alpine from "alpinejs";

import collapse from "@alpinejs/collapse";
import anchor from "@alpinejs/anchor";

window.htmx = htmx;
window.Alpine = Alpine;

Alpine.plugin(collapse);
Alpine.plugin(anchor);

Alpine.start();
