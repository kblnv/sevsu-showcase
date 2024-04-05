import {
  Livewire,
  Alpine,
} from "../../vendor/livewire/livewire/dist/livewire.esm";

import collapse from "@alpinejs/collapse";
import anchor from "@alpinejs/anchor";

Alpine.plugin(collapse);
Alpine.plugin(anchor);

Livewire.start();
