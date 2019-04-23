from PIL import Image
from PIL import ImageFilter

try:
    img = Image.open('images/test.jpg')
    # Abrir una imagen

    img.filter( ImageFilter.FIND_EDGES ).save('images/test_filter.jpg')
    # agregar filtro a la imagen y guardar

except IOError:
    print( 'No se encontro imagen' )


# Requisitos:
# pip install Pillow
# https://pillow.readthedocs.io/en/stable/  
# https://pillow.readthedocs.io/en/stable/reference/ImageFilter.html