Small Business Commissioner website operational manual
======================================================

General technical information
-----------------------------

The SBC Website is powered by wordpress running a custom Theme named SBCTheme. The SBC Complaints Scheme backend is powered by a helpdesk software called DeskPro. 

To view and respond to complaints filed under the SBC complaints scheme, go to the DeskPro agent interface:

- URL: https://sbctrial.deskpro.com/agent
- Username: (pending)
- Password: (pending)

To change the content of the website, go to the Wordpress administrator interface:

- URL: (pending)
- Username: wpadmin
- Password: (provided separately)

To configure the SBC complaints scheme, go to the DeskPro administrator interface:

- URL: https://sbctrial.deskpro.com/admin/
- Username: (pending)
- Password: (pending) 

SBC Website overview
--------------------

The SBC Website has the following components:

- An **Advice** section providing guidance and best practices to small businesses though multiple articles and sub-pages
- A **Business dispute** section providing a triage where multiple qualifying questions get asked in turn to determine a list of available help
- A **SBC Complaints** section providing an online form to to file a complaint under the SBC Complaints scheme
- **Complaint status** pages providing anonymous information about the current stage of a complaint
- A section for news and published SBC Complaint Scheme determinations

How to add content to the advice section
----------------------------------------

Advice articles are stored as Wordpress "pages", as sub-pages to "Advice".  Their wording can edited though the Wordpress administrator interface by going to Pages -> All Pages and locating the relevant article.

To add a new advice article:

1. Go to the Wordpress administrator interface (see above for credentials)
2. In the lefthand menu, select Pages -> Add new.
3. Select "Advice" as the parent page for a top-level advice article.
4. Author the title and content of the article.
5. Press "Publish" in the top right (you can also press "Preview" to see what the post will look like) 

You can also create sub-pages in your advice sections by choosing the relevant section as the parent article.

The complaints scheme workflow
------------------------------

Users can submit complaints through a form on the SBC Website. This will raise a ticket in the DeskPro helpdesk application, and can be processed through the web-based agent interface. For details on using the DeskPro agent interface, refer to the DeskPro manual.

The following workflow is defined for the complaints process:

1. **Initial investigation** (the SBC validates that the case merits investigation)
2. **Gathering data from complainant** (the SBC gets the complainant's side of the story)
3. **Gathering data from respondent** (the SBC gets the respondent's side of the story)
4. **Making determination** (the SBC prepares a determination and sends it to both parties)
5. **Gathering responses for determination** (the SBC provides an opportunity to both parties to comment)
6. **Closed**

A complaint can transition between stages as needed. For example, the complaint might be set to Closed after the initial investigation, or steps 2 and 3 could go through multiple iterations.

It's important to update the ticket when the complaints process moves to the next stage, which will update the complaint status page. To do so:

1. Go to the DeskPro agent interface (see above for credentials)
2. Select the relevant ticket
3. Click the cog icon in the top right of the "Properties" panel
4. Select the new stage in the "Workflow" dropdown
5. Click "Save"

Modifying the complaints scheme workflow
----------------------------------------

The workflow is defined in DeskPro. Additionally, descriptions for every stage are stored in Wordpress.

To add, edit or remove workflow stages

1. Go to the DeskPro administrator interface (see above for credentials)
2. In the left-hand menu, select Tickets -> Fields -> Workflows.
3. You can add a new Workflow stage; reorder them by dragging the three-bar icons; rename existing stages by clicking on their label; or remove them by clicking the "x" icon on the far right.
4. Click "Save".

If you add a new Workflow stage or rename an existing one, you will need make sure it is matched by an appropriate description to be shown on the user-facing ticket status page. To do so:

1. Go to the Wordpress administrator interface (see above for credentials)
2. In the lefthand menu, select Pages -> Add new
3. Add a title that exactly matches the name of the Workflow stage in DeskPro
4. Author the description of the stage in the content box.
5. Set the Parent of the page to "SBC Complaints"
6. Press "Publish" in the top right (you can also press "Preview" to see what the post will look like) 

Note that updating the colours corresponding to Workflow stages in the Complaint status history requires modification of the `sbctheme.css` file in the Wordpress theme. 


How to publish determination reports
------------------------------------

1. Go to the Wordpress administrator interface (see above for credentials)
2. In the lefthand menu, select Posts -> Add new
3. Add a title and a short summary about the determination
4. Press the "Add Media" button in the top left and follow the instructions to attach the determination report.   
5. In the "Categories" section on the right hand side, choose "Determination Reports"
6. Press "Publish" in the top right (you can also press "Preview" to see what the post will look like)


How to publish news items
-------------------------

1. Go to the Wordpress administrator interface (see above for credentials)
2. In the lefthand menu, select Posts -> Add new
3. Add a title and the contents of the news article
5. In the "Categories" section on the right hand side, choose "News"
6. Click "Publish" in the top right (you can also click "Preview" to see what the post will look like)

How to modify the triage process
--------------------------------

Every question in the triage process is a "page" in wordpress, as Sub-pages to the "Business dispute" page define the question in their content. Additionally, they have a custom property "next" which indicates the next question to be asked. For example for q1 (the first question) the value of "next" is "q2" (the second question). For the last question, the value of "next" is "results", indicating that the results page should be rendered.

For example, in order to add a question after the final question:

1. Go to the Wordpress administrator interface (see above for credentials)
2. In the lefthand menu, select Pages -> Add new
3. Add a simple lowercase title, for example "q6" if the new question is the sixth question
4. In the content box, select the "Text" tab on the top right and write out the html for your answers (see below) 
5. Set the Parent of the page to "Business disputes" and the Template to "Triage page"
6. Ensure that the "Custom Fields" box is shown in the edit screen. It should be at the bottom of the screen; if it isn't, click "Screen Options" in the top right of the screen and check "Custom Fields" in the panel that appears.
7. In the "Custom Fields" box, add a custom field with the name "next" and the value to the page that should be displayed after the question (in our case, "results").
8. Press "Publish" in the top right (you can also press "Preview" to see what the post will look like) 
9. In the administrator interface, go to Pages -> All Pages and click to edit the previous question (in our example, "q5")
10. In the "Custom Fields" box, set the value of the "next" field to the newly created question (in our example, "q6")
11. Press "Update" to save your changes.

The HTML of the questions can be adopted from the following example
``` 
 <fieldset class="form-group">
   <h3 id="question">Your question text goes here</h3>
   <label class="block-label" for="radio-1"><input id="radio-1" name="q6" type="radio" value="1" />Option one</label>
   <label class="block-label" for="radio-2"><input id="radio-2" name="q6" type="radio" value="2" />Option two</label>
   <p class="form-block">or</p>
   <label class="block-label" for="radio-3"><input id="radio-3" name="q6" type="radio" value="-1" />Option three</label>
 </fieldset>
```

Things worth noting:

- The "name" parameter in each option must be eqal to the title of the new question ("q6" in our example)
- The "value" paramenter has to be different for each option
- The block that says "or" is optional and can be safely removed 
- You can have any number of options

How to add and edit triage outcomes
-----------------------------------

Every triage outcome is stored as a Wordpress "page", as a Sub-page to "Results". Their wording can edited though the Wordpress administrator interface by going to Pages -> All Pages and locating the relevant triage outcome page.

To add a new triage outcome:

1. Go to the Wordpress administrator interface (see above for credentials)
2. In the lefthand menu, select Pages -> Add new
3. Add a descriptive title
4. In the content box, write the summary of the outcome. (tip: copy the contents of an existing triage outcome to get the formatting right)
5. Ensure that the "Custom Fields" box is shown in the edit screen. It should be at the bottom of the screen; if it isn't, click "Screen Options" in the top right of the screen and check "Custom Fields" in the panel that appears.
6. In the "Custom Fields" box, add filter criteria for inclusion/exclusion of this outcome based on the triage answers provided (see below).
8. Press "Publish" in the top right (you can also press "Preview" to see what the post will look like) 

**About filter criteria:** 

With filters, you can define the logic To add a filter, add a custom field with key "filter_XX" (where xx is the name of the question to filter by) and set as the value a comma-separated list of acceptable answers. For example, if you want to show this outcome only if users give answers 1 or 2, but not 3 in question "q1", the key would be "filter_q1" and the value would be "1,2". 

You can specify any number of filters. If no filter is specified for a question, the outcome is shown for any answer.

