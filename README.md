# Dasalomao Kanastra Chalenge - (Laravel Back End API)

<!-- PROJECT -->
<br />
<p align="center">

  <img src="https://avatars.githubusercontent.com/u/96804932?s=200&v=4" alt="Logo" width="80" height="80">

  <h3 align="center">Dasalomao Kanastra Chalenge - (Laravel Back End API)</h3>

  <p align="center">
     This application an API with two end-points beeing:
    <br />
  </p>
    <ul align="center">
        <li>- A upload csv file.</li>
        <li>- Uploaded csv (batch) files list.</li>
    </ul>
    <p align="center">
        It also contains two queueable jobs:
    </p>
    <ul align="center">
        <li>- One for processing the uploaded files in batches to a 'files' queue</li>
        <li>- Another for using the data saved to the DB from those files to create payment tickets pdfs and send them via emails</li>
    </ul>
</p>
