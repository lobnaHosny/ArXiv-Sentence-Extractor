# Sentence-Extractor [![Python 3.6](https://img.shields.io/badge/python-3.7-blue.svg)](https://www.python.org/downloads/release/python-370/)


This is a tool to help research students find relevant quotations in research papers automaically. <br><br>
It downloads pdf papers related to the research topic from <a href="https://arxiv.org/">arXiv</a>, then extracts only the relevant 
sentences from these papers based on key terms or phrases entered by the user. 
It then displays these senteces in a txt file, along with their references.
<br><br>
It can be used as either a script file or a web application.
<h2>Installation</h2>

1- Download the files in this repo. <br>
Note: If you want to use this tool as a web application (see below), and assuming you are using <a href="https://www.apachefriends.org/index.html">xampp</a>,
move the files to <i>htdocs</i>
<br>

2- Run the following command while inside the folder downloaded from the repo :
<code>python -m pip install .</code>


<h2>Usage as a Script File</h2>

The script file, <code>extract.py</code>, takes five arguments:  <br>

```bash
py extract.py  search_arxiv_and   search_arxiv_or   dest   max_len   search_pdf
```

Where:

Argument           | Notes
-------------------|----------
`search_arxiv_and` | comma-separated list of search terms that <strong>must all</strong> be in the result<br>E.g.: <strong>nuclear, energy</strong> translates to <strong>nuclear AND energy</strong><br>If you don't want to use this argument, set it as "0"
`search_arxiv_or`  | comma-separated list of search terms where <strong>at least one must </strong> be in the result<br>E.g.: <strong>nuclear, energy</strong> translates to <strong>nuclear OR energy</strong><br>If you don't want to use this argument, set it as "0"
`dest`             | directory to save results to, it's recommended to use a different directory for each time the tool is used
`max_len`          | maximum number of papers to be installed
`search_pdf`       | extract sentences from the papers that contain this phrase/word in them


<h2> Examples </h2>

<h3>Ex #1</h3>

```bash
py extract.py  "air, filter"  "0"   C:/Users/JohnDoe/Desktop/myresults   3   "filter"
```
The above will download <strong>3</strong> papers that have the words <strong>air AND filter</strong>, and will extract the sentences that have the word <strong>filter</strong> from them.

<h3>Ex #2</h3>

```bash
py extract.py  "nuclear energy", harms "  "0"   C:/Users/JohnDoe/Desktop/myresults   10   "danger"
```
The above will download <strong>10</strong> papers that have the words <strong>nuclear energy AND harms</strong>, and will extract the sentences that have the word <strong>danger</strong> from them.

<h3>Ex #3</h3>

```bash
py extract.py  "nuclear energy, generator"  "power, electricity"   C:/Users/JohnDoe/Desktop/myresults   5   "danger"
```

The above will download <strong>5</strong> papers that have the words <strong>nuclear energy AND generator power OR electricity</strong>, and will extract the sentences that have the word <strong>danger</strong> from them.


<h2> Usage as a web application </h2>

This is quite similar to the script format, except that it comes with a simple GUI.<br><br>
To use the web application, type `localhost/[put name of directory where files are saved inside htdocs/interface.php` in your web browser. 
<br><br>It will probably look something like this: `localhost/Sentence-Extractor-master/interface.php`

<h2>Output</h2>

After using the tool, the directory mentioned in `dest` will contain the papers found in arXiv as PDFs, as well as a file called `results.txt`, which includes the extracted sentences with their reference.<br>
There will also be another txt file called `convert.txt`, which contains the text of all the downloaded papers.

