# pip install selenium
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from time import sleep

# todo: check internet conditions before attempting to download
# initialize the web driver
driver = webdriver.Firefox()

# Open the tutorials point website using get() method
driver.get("https://drive.google.com/drive/folders/1Hmt9w5LzJ8E9gVRWu2hzoqX0Mgq08pZm")

# clicking the courses tab in homepage.
# driver.find_element(By.XPATH,"(//div[.= 'Fazer download de tudo'])[3]").click()
# todo: replace the message 'Fazer download de tudo' according to the language
WebDriverWait(driver, 1000000).until(EC.element_to_be_clickable((By.XPATH, "(//div[.= 'Fazer download de tudo'])[3]"))).click()

#todo: wait until download is finished. Use awaitUntil an object related to the download is displayed.
# with this approach we would not need to wait 20 seconds

# Wait 20 seconds before closing the browser
sleep(20)
driver.close()
driver.quit()