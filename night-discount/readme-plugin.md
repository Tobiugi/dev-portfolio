# WooCommerce Night Discount Plugin

To jest autorska wtyczka do WooCommerce, stworzona w celu zademonstrowania umiejętności pracy z systemem zaczepów (Hooks API) oraz rozszerzania metadanych produktów.

## Funkcjonalności
* **Automatyczny rabat:** System sprawdza godzinę serwera i jeśli mieści się ona w przedziale 22:00 - 06:00, obniża cenę produktu o 10%.
* **Custom Product Fields:** Dodanie pola typu checkbox do panelu edycji produktu w zakładce "Ustawienia główne".
* **Conditional Logic:** Rabat nalicza się tylko dla produktów, które mają zaznaczoną opcję "Włącz zniżkę nocną".

## Techniczne aspekty (Co pokazuje ten kod?)
* **Action Hooks:** Wykorzystanie `woocommerce_product_options_general_product_data` do wstrzyknięcia pola w UI oraz `woocommerce_process_product_meta` do zapisu danych.
* **Filter Hooks:** Zastosowanie `woocommerce_product_get_price` do dynamicznej modyfikacji ceny "w locie" bez trwałej zmiany ceny w bazie danych.
* **Data Sanitization:** Bezpieczne pobieranie i zapisywanie metadanych produktu za pomocą `get_post_meta` i `update_post_meta`.

## Instalacja i konfiguracja
1. Skopiuj folder `night-discount` do katalogu `/wp-content/plugins/` swojej instalacji WordPress.
2. Aktywuj wtyczkę w panelu administracyjnym.
3. Wymagany zainstalowany i aktywny **WooCommerce**.
4. Aby przetestować działanie, edytuj dowolny produkt, zaznacz checkbox "Włącz zniżkę nocną" i sprawdź cenę produktu w godzinach nocnych (lub zmień warunek `if` w kodzie dla celów testowych).