import requests

params = {
  'key': '1kekecMN31fxge0j'
}
response = requests.get('http://api.asg.northwestern.edu/terms/', params=params)
# calling response.json() returns the response as a Python dictionary or list
print response.json()