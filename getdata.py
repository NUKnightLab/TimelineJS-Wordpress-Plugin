"""
	This script uses Northwestern University's course API to gather information about offered courses.The API is structured in a way that certain queries can only be made with a minimum number of parameters. Thus, the process for arriving at a JSON file with all the courses offered in one term is as follows:

		1) Retrieve list of all terms.
		2) Retrieve unique ID of latest term available.
		3) Use unique ID of term to retrive list of all subjects for which courses are being offered for that term.
		4) Retrieve subject ID for each of those subjects.
		5) Use unique ID of term and subject ID to retrieve list of all courses offered for each subject being offered in that term. 

"""

import requests

params = {
  "key": "1kekecMN31fxge0j" #api key
}

base_url = "http://api.asg.northwestern.edu/"

# get response from api call to get json of all the terms
response = requests.get(base_url + "terms", params=params)

# turn response into a json file
response_json = response.json()

# latest term info is always in the first index of the json file
latest_term = response_json[0]

# get the unique id of latest term
latest_term_id = latest_term["id"]

# get response from api call to get json of all subjects available for each term
print latest_term_id

