import requests
import hashlib
import os
import playsound
import time
from datetime import datetime

def getWebsiteHash():
  response = requests.get('https://tricblueteam.com')
  result = hashlib.md5(response.text.encode()) 
  md5Hash = result.hexdigest()
  return md5Hash

def checkWebsite():
  md5Hash = getWebsiteHash()
  with open('hashfile.txt', 'r') as reader:
   fileHash = reader.read()
  if (md5Hash != fileHash):
    now = datetime.now();
    print('A FISH BEEN CAUGHT: ' + now.strftime("%I:%M:%S %p"));
    f = open( 'hashfile.txt', 'w' )
    f.write(md5Hash)
    f.close()
    playsound.playsound('music/win98.mp3', True)
  #else:
    #print('Website is the Same.')
    


def main():
  checkWebsite()

if __name__ == "__main__":
  while True:
    main()
    time.sleep(2)
