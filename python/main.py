from twitter import *
from gleamdata import data
from selenium.webdriver.firefox.options import Options
from selenium import webdriver
import multiprocessing as mp
from multiprocessing import Pool
from operator import is_not
from functools import partial
from pyvirtualdisplay import Display

def worker():
    op = Options();

    #driver = webdriver.Firefox(firefox_profile=firefoxProfile, firefox_options=op)
    driver = webdriver.Chrome()
    try:
        shortset = set([])
        for i in range(20):
            nonduplink = set([])
            print('launching twitter')
            links = launch_twitter(driver) #grabs list of gleam urls from twitter

            print('urls grabbed from twitter')
            #print(links)
            poo = Pool(processes=20)
            valid = set(poo.map(expand, links))
            poo.close()
            poo.terminate()
            poo.join()
            del links
            valid = filter(partial(is_not, None), valid)
            #valid = set(expand(links))
            print(valid)
            print("have expanded links")
            shortened = []
            for s in valid:
                if 's' in s[7]:
                    shortened.append(s[:24])
                else:
                    shortened.append('https:/' + s[7:24])
            print("links have been shortened")
            del valid
            #print(shortened)
            for a in shortened:
                if a not in shortset:
                    nonduplink.add(a)
                    shortset.add(a)
            print('removed dupes')
            del shortened
            big_daddy = []
            for u in nonduplink:
                print(u)
                d = gatherinfo(u, driver)
                big_daddy.append(data(d[0], d[1], d[2]))
            insert(big_daddy)
            del big_daddy
    except Exception as e:
        print(e)
        driver.close()
        driver.quit()
        return
    driver.close()
    driver.quit()
  

if __name__ == '__main__':
    while True:
        display = Display(visible=0, size=(800,600))
        display.start()
        p = mp.Process(target=worker())
        p.start()
        display.stop()
        p.join()
