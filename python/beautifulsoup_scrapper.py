from bs4 import BeautifulSoup
import requests

GOOGLE_NEWS_URL = 'https://news.google.com/search?q=panama&hl=es-419&gl=US&ceid=US:es-419'

def scraping_site():
        re = requests.get( GOOGLE_NEWS_URL )
        if re.status_code == 200:
                soup = BeautifulSoup( re.text, 'html.parser' )

                if soup is not None:
                        articles = soup.find_all('h3', {'class':'ipQwMb ekueJc RD0gLb'})

                        for article in articles:
                                title = article.find('a', {'class':'DY5T1d'} ).getText()
                                print title

if __name__ == '__main__':
    scraping_site()

# Requisitos:
# pip install beautifulsoup4
# pip install requests