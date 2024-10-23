CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--

INSERT INTO `users` (`id`, `name`,`last_name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(2,     'fernando', 'ejemplo','fer12@gmail',        NULL, '$2y$12$ZMUe6ucJb8oAJqGnUtLqGeGCwQz/c0fbjUQffWZYbJjWblAvk.McO', 'cliente',        NULL, '2024-09-04 03:19:04', '2024-09-04 03:19:04'),
(3,     'pedro',    'ejemplo','pedro@hotmail.com',  NULL, '$2y$12$z4dWaYoshPaOknVVIlzivepyVMGu2Kg3ggrMEwAhdt7JK/rOtUU1W', 'cliente',        NULL, '2024-09-04 03:20:58', '2024-09-04 03:20:58'),
(4,     'maria',    'ejemplo','mari@gmail.com',     NULL, '$2y$12$5U1NmXrpK9cCaXNjB.vfSu8z7Z8A2CXhJKFZRewTbQaZjcZUEWI5.', 'cliente',        NULL, '2024-09-04 03:47:42', '2024-09-04 03:47:42'),
(5,     'flor',     'ejemplo','flor12@gmail.com',   NULL, '$2y$12$mqQGKWEhwgMGvJyoVZFUEuTWTY6PG84IsqZ/AOq6GkooXN/STQJOm', 'cliente',        NULL, '2024-09-04 06:01:17', '2024-09-04 06:01:17'),
(7,     'pepe',     'ejemplo','pepe@gmail.com',     NULL, '$2y$12$7DpgZSq9UWgr0k0jRPtwv.du7OEF3evv3.J1EYcK41F.ekXGIT2ma', 'super_admin',    NULL, '2024-09-04 07:13:34', '2024-10-11 03:00:28'),
(8,     'flopi',    'ejemplo','flopi11@gmail.com',  NULL, '$2y$12$rWUiFbkjXAGPRHqJczoGhumT8Bxz00UZEPza7xWMmmSjLc4OF0eEK', 'admin',          NULL, '2024-10-10 08:55:03', '2024-10-10 08:55:03'),
(10,    'fer',      'ejemplo','fer11@gmail.com',    NULL, '$2y$12$5NiK70aqmahB/cg5e5VNSOWUcK7DMVF62Pj13YXYXawdM2pey3m02', 'cliente',        NULL, '2024-10-19 07:01:43', '2024-10-19 07:01:43'),
(12,    'ema',      'ejemplo','ema@gmail.com',      NULL, '$2y$12$X89NBlXm3tQcQqrylvtNmOBo4Dez9/5J9JVQwSoMTBYvv.awpdik6', 'admin',          NULL, '2024-10-19 07:08:49', '2024-10-19 07:08:49');


INSERT INTO categories (name) VALUES
('Aceite'),
('Arroz'),
('Artículos de papel'),
('Azúcar'),
('Bebidas'),
('Carne'),
('Cervezas'),
('Conservas'),
('Cordero'),
('Embutidos'),
('Harinas'),
('Leche'),
('Legumbres'),
('Licores'),
('Panes y bollería'),
('Pasta'),
('Productos de higiene personal'),
('Productos de limpieza'),
('Sal'),
('Snacks'),
('Té'),
('Vinos'),
('Jugos');


INSERT INTO types (name) VALUES
('Unidad'),
('KG');



INSERT INTO `products` (`id`, `catalog_id`, `name`, `description`,`unit_price`,`bulk_unit_price`, `bulk_unit`, `percent_off`, `offer`, `price_offer`,`old_price`, `stock`, `image_url`, `category_id`, `type_id`, `created_at`, `updated_at`) VALUES
(5,  111122223333, 'otro arroz',                    'es otro arroz prueba actualizado',                                         2000.00,        1900.00,    NULL,   NULL,       0,      NULL,       NULL,   0,      '/image_url/default.jpeg', 4, 1, '2024-09-12 23:52:56', '2024-10-10 08:11:54'),
(6,  33332222,     'arroz ala 2',                   '33333333333',                                                              3000.00,        2000.00,    NULL,   NULL,       0,      NULL,       NULL,   1,      'image_url/1726175755_arroz.png', 4, 1, '2024-09-13 00:15:56', '2024-09-13 00:15:56'),
(9,  44422222,     'milanesa',                      'carnitaaa',                                                                12000.00,       NULL,       NULL,   NULL,       0,      NULL,       NULL,   1,      'image_url/1726182894_milanesa-de-cuadrada.jpg', 10, 2, '2024-09-13 02:14:54', '2024-09-13 02:14:54'),
(11, 32221111,     'trompetas',                     'hhhhhhh',                                                                  500.00,         NULL,       NULL,   NULL,       0,      NULL,       NULL,   0,      '/image_url/default.jpeg', 3, 2, '2024-09-13 15:05:48', '2024-09-13 15:05:48'),
(12, 23211,        'azucar',                        'azucaaaaaaaaaar',                                                          22222.00,       NULL,       NULL,   NULL,       0,      NULL,       NULL,   0,      '/image_url/default.jpeg', 6, 2, '2024-09-13 15:09:33', '2024-09-13 15:09:33'),
(13, 33333321111,  'azucar 1',                      'azucar 1',                                                                 1000.00,        NULL,       NULL,   NULL,       0,      NULL,       NULL,   1,      '/image_url/default.jpeg', 6, 2, '2024-09-13 15:18:15', '2024-09-13 15:18:15'),
(14, 55555,        'azucar 2',                      'azucar 2',                                                                 3000.00,        NULL,       NULL,   NULL,       0,      NULL,       NULL,   1,      '/image_url/default.jpeg', 6, 2, '2024-09-13 15:21:21', '2024-09-13 15:21:21'),
(25, 555666777,    'producto prueba actualizado',   'producto pruebaproducto prueba actualizado',                               30000.00,       20000.00,   NULL,   NULL,       0,      NULL,       NULL,   0,      'image_url/1726504411_pan 2.jpg', 4, 1, '2024-09-14 00:46:59', '2024-09-16 19:33:31'),
(26, 1212133131,   'Ricotero',                      'no',                                                                       12900.00,       11000.00,   NULL,   NULL,       0,      NULL,       NULL,   1,      'image_url/1726344978_indio.jpg', 14, 1, '2024-09-14 23:16:18', '2024-09-18 07:29:08'),
(28, 888999,       'pepeeee',                       'el pan esta acaaaaaaa',                                                    222.00,         NULL,       NULL,   NULL,       0,      NULL,       NULL,   1,      'image_url/1726633100_pan 2.jpg', 13, 2, '2024-09-15 05:31:57', '2024-10-03 21:49:04'),
(30, 2323343434,   'aaaaaaa',                       'aaaaaa11111',                                                              1111111.00,     NULL,       NULL,   NULL,       0,      NULL,       NULL,   1,      'image_url/1726500549_arroz.png', 10, 2, '2024-09-16 18:29:09', '2024-09-16 18:29:09'),
(33, 444,          'prueba 4',                      'prueba 4',                                                                 1000.00,        2000.00,    NULL,   NULL,       0,      NULL,       NULL,   1,      'image_url/1728452543_pan.jpg', 6, 1, '2024-10-08 07:52:40', '2024-10-10 08:49:51'),
(39, 444444,       'arroz del bueno',               'ultra oferta de ultima hora',                                              1000.00,        NULL,       NULL,   20,         1,      1000.00,    NULL,   1,      'image_url/1729187780_arroz.png', 4, 1, '2024-10-17 20:56:20', '2024-10-17 20:56:20'),
(40, 1212121213,   'nuevo producto',                'nuevo producto nuevo producto nuevo producto',                             10001.00,       NULL,       NULL,   NULL,       0,      NULL,       NULL,   1,      'image_url/default.jpeg', 4, 2, '2024-10-19 07:04:43', '2024-10-19 07:04:43'),
(41, 33332,        'ultra oferta de arroz',         'ultra oferta de arroz ultra oferta de arroz ultra oferta de arroz',        1000.00,        NULL,       NULL,   30,         1,      100.00,     NULL,   1,      'image_url/default.jpeg', 4, 1, '2024-10-19 07:22:28', '2024-10-19 07:34:47');


--carrito 
-- id id_user catalog_id name quantity price url_image cart_id