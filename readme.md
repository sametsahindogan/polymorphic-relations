## Proje Hakkında


Modüllerden (Tag ve Category) oluşan basit bir blog sistemi.

- Tag ve Category modülleri Posts ile many to many polymorphic relation'a sahip. 
- Taggable ve Categorizable Trait'leri çağırılarak modüller kullanılabilir.
- Her bir modül ve proje gerekli migration ve seeder sınıflarına sahiptir.


--

`composer install `

`composer dump-autoload`

`php artisan module:use *module_name*`

`php artisan module:enable *module_name*`

`php artisan module:migrate *module_name* `

`php artisan module:seed *module_name* `

`php artisan module:publish-config *module_name*`

`php artisan migrate`

`php artisan db:seed`

`php artisan key:generate`

--

Komutları ile proje çalıştırılmaya hazır hale gelecektir.
