import requests
from time import sleep

def resolve_url(url):
    try:
        r = requests.get(url)
    except requests.exceptions.RequestException:
        return (url, None)
    if r.status_code != 200:

        longurl = None
    else:
        longurl = r.url

    return (url, longurl)

def resolve_url_req(url):
    session = requests.Session()  # so connections are recycled
    resp = session.head(url, allow_redirects=True)
    session.close()
    return resp.url
