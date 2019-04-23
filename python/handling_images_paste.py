from PIL import Image

try:
    img = Image.open('images/test.jpg')
    # Abrir una imagen

    copy = img.resize( (500,500) )
    img.paste( copy, (100,100) )
    img.save("images/test_paste.jpg")

except IOError:
    print( 'No se encontro imagen' )


# Requisitos:
# pip install Pillow
# https://pillow.readthedocs.io/en/stable/  