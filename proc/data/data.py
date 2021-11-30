import requests
from bs4 import BeautifulSoup
 
response = requests.get("https://times-info.net/P14-kanagawa/C204/")
 
soup = BeautifulSoup(response.content,"html.parser")
 
#found1 = data.find('div', class_='s_ichiran_info_name ellipsis')

found2 = soup.find('div', class_='s_ichiran_info_name ellipsis')
#print(found1)
print(found2)