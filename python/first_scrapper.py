import urllib

def get_page():
	open_file = open('econpy.html', 'w');
	html_file = urllib.urlopen('http://econpy.pythonanywhere.com/ex/001.html')
	html_file = html_file.read()

	open_file.write( html_file )
	open_file.close()

if __name__ == '__main__':
	get_page()