from PIL import Image

try:
    img = Image.open('images/test.jpg')
    # Abrir una imagen

    print( 'size:' )
    print( img.size )
    # mostrar tamanio de la imagen

    print( 'width:' )
    print( img.width )
    # mostrar el ancho de la imagen

    print( 'height:' )
    print( img.height )
    # mostrar altura de la imagen

    print( img.mode )
    # Obtener el Modo de la imagen

    print( img.getpixel( (100, 100) ) )
    # Obtener el color de un pixel

    img = img.convert( 'L' )
    # Convertir la imagen a Blanco y Negro

    img.save('images/test_bn.jpg')
    # Guardar una imagen

    img.rotate( -45, expand = True ).save('images/test_rotate.jpg')
    # Rotar la imagen en 45 grados permitiendo que se expanda la imagen y guardar
    # img.save('images/test_rotate.jpg')

    img.transpose( Image.ROTATE_90 ).save('images/test_rotate2.jpg')
    # rotate in 90 degree steps and save

    img.resize( ( 200 , 200 ) ).save('images/test_resize.jpg')
    # Returns a resized copy of this image

    box = ( 300, 100, 500, 500 )
    img.crop( box ).save( 'images/test_crop.jpg' )
    # cortar una imagen y guardar
    
    #img.show()
    # mostrar imagen
except IOError:
    print( 'No se encontro imagen' )


# Requisitos:
# pip install Pillow
# https://pillow.readthedocs.io/en/stable/