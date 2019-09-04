import wget  # to download files
import subprocess  # to execute CLI commands
import sys
import os  # to execute basic CLI statements
import re  # to execute regular expressions
import arxiv #arxiv API
#from textblob import TextBlob #separation of text to sentences 



### retreiving arguments from user input ###

#Find paper 
search_arxiv_and = str(sys.argv[1])  # get user input
if search_arxiv_and.replace("'", "") == "0":
    search_arxiv_and = ""
else:
    search_arxiv_and = search_arxiv_and.replace("'", "") #removing unnecessary quotes 
    search_arxiv_and = search_arxiv_and.replace(",", "\" AND \"") #adding logic
	search_arxiv_and = "\"" + search_arxiv_and + "\""


search_arxiv_or = str(sys.argv[2])  # get user input
if search_arxiv_or.replace("'", "") == "0":
    search_arxiv_or = ""
else:
    search_arxiv_or = search_arxiv_or.replace("'", "")  # removing unnecessary quotes
    search_arxiv_or = search_arxiv_or.replace(",", "\" OR \"")  # adding logic
	search_arxiv_or = "\"" + search_arxiv_or + "\""

search_arxiv = search_arxiv_and + " " + search_arxiv_or


#Directory to save papers in
dest = str(sys.argv[3])
dest = dest.replace("'", "")  
if dest[-1] != "/":
	dest = dest + "/"


#Maximum number of papers to download
max_len = int(sys.argv[4])

#Search within papers
search_pdf = str(sys.argv[5]) 
search_pdf = search_pdf.replace("'", "")  
search_pdf = search_pdf.replace(",", " AND")



result = arxiv.query(query=search_arxiv, max_results=max_len)



j = 1

for paper in result: #for each paper found in the search

    if 'links' in paper: #if the paper has the attribute 'links'
        links = paper['links']
        for i in links: #for every link 
            if i['type'] == 'application/pdf': #if that link is a pdf
                h = i['href'] #save the href of that link in 'h'
                file = "pdf" + str(j) + ".pdf" #creating the file name
                dest_file = dest+file #concatenating the filename with the fimepath input by user
                wget.download(h, dest_file) #download the pdf to the directory
                j = j + 1 



k = 1


with open(dest+"result.txt", "a+") as text_file: #creating the txt file that will contain final extractions
    
    while k < j: #while there are more pdf files that haven't been analysed

            #Converting pdf to txt
            os.system("pdf2txt.py -o " + dest + "convert.txt " +
                      dest + "pdf" + str(k) + ".pdf")
            
            #open the convered txt file
            txtfile = open(dest+"convert.txt", encoding='utf-8')
            text = txtfile.read()
            
            #check if there are any non-ASCII characters and remove them
            text = re.sub(r'[^\x00-\x7F]+', ' ', text)

            #
            pattern = re.compile(r'[\w][^\.]+\.')
            matches = pattern.finditer(text)

            for match in matches:
                x = match.span()[0]
                y = match.span()[1]
                if search_pdf in text[x:y]:
                    text_file.write("{0} \n\n\n".format(text[x:y]))
                    text_file.write(
                        "Reference: {0}, ".format(result[k-1]['title']))
                    for auth in result[k-1]['authors']:
                        text_file.write("{0}, ".format(auth))
                    text_file.write(
                        "{0} \n\n\n -----------------------------\n\n\n".format(result[k-1]['published'][:4]))

            k = k+1

