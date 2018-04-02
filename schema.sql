DROP DATABASE IF EXISTS blog;
CREATE DATABASE blog;
USE blog;

DROP TABLE IF EXISTS Image;
CREATE TABLE Image (
  id INT AUTO_INCREMENT PRIMARY KEY,
  adress VARCHAR(100)
)ENGINE=InnoDB;

INSERT INTO Image (adress)
VALUES ('9a74c123b781213efd7920dbf102f22d.jpeg'),
       ('d027eb0ee23c9fcaa2b9ce4f221c5a77.jpeg');

DROP TABLE IF EXISTS Article;
CREATE TABLE Article (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(100) NOT NULL,
  subTitle VARCHAR(100),
  content TEXT NOT NULL,
  publicationDate DATETIME NOT NULL,
  imageId INT,
  CONSTRAINT fk_image_article
        FOREIGN KEY (imageId)
        REFERENCES Image(id)
)ENGINE=InnoDB;

INSERT INTO Article (title, subTitle, content, publicationDate, imageId)
VALUES
('Article 1', 'Test1', ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam condimentum mauris vel nisl volutpat suscipit. Mauris vehicula sodales urna malesuada pharetra. Suspendisse potenti. Vestibulum vel ultrices mauris. Cras hendrerit urna sapien, eget convallis justo fermentum non. Donec et dignissim nulla, sit amet suscipit enim. Fusce justo sapien, malesuada ac imperdiet quis, tempus eget justo. Aenean ac nulla vulputate, consectetur neque vitae, luctus dui. In cursus pharetra libero, quis luctus mauris ultricies at. Nam purus nibh, lacinia sit amet congue in, scelerisque at eros. Quisque rutrum augue nulla, ac porttitor dui tincidunt eu. Vivamus accumsan, lectus vitae finibus pharetra, nunc sem posuere ante, pretium fermentum sapien mi porttitor nunc. Donec venenatis sit amet sem vel euismod. Vestibulum quis enim ante.
Nulla vestibulum eleifend tempor. In lorem enim, accumsan eget pretium non, ornare non enim. Vivamus ac blandit nisi, luctus fringilla sapien. Donec a porta ipsum, sit amet ultrices lectus. Cras quam ligula, vulputate nec nulla a, mollis venenatis massa. Mauris pharetra urna in dignissim interdum. Maecenas venenatis, ligula non efficitur imperdiet, eros elit laoreet neque, in pulvinar odio odio aliquet augue. Suspendisse ut augue nisi. Sed tristique luctus ante sed auctor. Aenean tempus lacus eu orci tempus faucibus. Pellentesque quis semper massa. Suspendisse porta dolor quis sapien semper, et rhoncus diam placerat. Quisque imperdiet enim eu mauris convallis interdum. Etiam quis interdum enim. Maecenas egestas tortor sit amet magna pretium convallis. Pellentesque suscipit est id euismod egestas.', NOW(), 1),
('Article 2', 'Test2', ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam condimentum mauris vel nisl volutpat suscipit. Mauris vehicula sodales urna malesuada pharetra. Suspendisse potenti. Vestibulum vel ultrices mauris. Cras hendrerit urna sapien, eget convallis justo fermentum non. Donec et dignissim nulla, sit amet suscipit enim. Fusce justo sapien, malesuada ac imperdiet quis, tempus eget justo. Aenean ac nulla vulputate, consectetur neque vitae, luctus dui. In cursus pharetra libero, quis luctus mauris ultricies at. Nam purus nibh, lacinia sit amet congue in, scelerisque at eros. Quisque rutrum augue nulla, ac porttitor dui tincidunt eu. Vivamus accumsan, lectus vitae finibus pharetra, nunc sem posuere ante, pretium fermentum sapien mi porttitor nunc. Donec venenatis sit amet sem vel euismod. Vestibulum quis enim ante.
Nulla vestibulum eleifend tempor. In lorem enim, accumsan eget pretium non, ornare non enim. Vivamus ac blandit nisi, luctus fringilla sapien. Donec a porta ipsum, sit amet ultrices lectus. Cras quam ligula, vulputate nec nulla a, mollis venenatis massa. Mauris pharetra urna in dignissim interdum. Maecenas venenatis, ligula non efficitur imperdiet, eros elit laoreet neque, in pulvinar odio odio aliquet augue. Suspendisse ut augue nisi. Sed tristique luctus ante sed auctor. Aenean tempus lacus eu orci tempus faucibus. Pellentesque quis semper massa. Suspendisse porta dolor quis sapien semper, et rhoncus diam placerat. Quisque imperdiet enim eu mauris convallis interdum. Etiam quis interdum enim. Maecenas egestas tortor sit amet magna pretium convallis. Pellentesque suscipit est id euismod egestas.', NOW(), 2),
('Article 3', 'Test3', ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam condimentum mauris vel nisl volutpat suscipit. Mauris vehicula sodales urna malesuada pharetra. Suspendisse potenti. Vestibulum vel ultrices mauris. Cras hendrerit urna sapien, eget convallis justo fermentum non. Donec et dignissim nulla, sit amet suscipit enim. Fusce justo sapien, malesuada ac imperdiet quis, tempus eget justo. Aenean ac nulla vulputate, consectetur neque vitae, luctus dui. In cursus pharetra libero, quis luctus mauris ultricies at. Nam purus nibh, lacinia sit amet congue in, scelerisque at eros. Quisque rutrum augue nulla, ac porttitor dui tincidunt eu. Vivamus accumsan, lectus vitae finibus pharetra, nunc sem posuere ante, pretium fermentum sapien mi porttitor nunc. Donec venenatis sit amet sem vel euismod. Vestibulum quis enim ante.
Nulla vestibulum eleifend tempor. In lorem enim, accumsan eget pretium non, ornare non enim. Vivamus ac blandit nisi, luctus fringilla sapien. Donec a porta ipsum, sit amet ultrices lectus. Cras quam ligula, vulputate nec nulla a, mollis venenatis massa. Mauris pharetra urna in dignissim interdum. Maecenas venenatis, ligula non efficitur imperdiet, eros elit laoreet neque, in pulvinar odio odio aliquet augue. Suspendisse ut augue nisi. Sed tristique luctus ante sed auctor. Aenean tempus lacus eu orci tempus faucibus. Pellentesque quis semper massa. Suspendisse porta dolor quis sapien semper, et rhoncus diam placerat. Quisque imperdiet enim eu mauris convallis interdum. Etiam quis interdum enim. Maecenas egestas tortor sit amet magna pretium convallis. Pellentesque suscipit est id euismod egestas.', NOW(), null);
