<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Course Lesson - Creating Your Online Brand</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    :root {
      --bs-primary: #dc3545; /* Red */
      --bs-secondary: #6c757d; /* Grey */
    }
    .glossary-box {
      border: 1px solid var(--bs-secondary);
      padding: 15px;
      border-radius: 6px;
      background-color: #f8f9fa;
    }
    .tab-content-box {
      border: 1px solid #dee2e6;
      border-top: none;
      padding: 15px;
    }
    .nav-link{
        color:  #dc3545; 
    }
    .nav-link:hover {
        color:rgb(56, 57, 59);
    }
  </style>
</head>
<body>
  <div class="container py-4">
    <div class="mb-3">
      <h2 class="text-danger">Name of Module</h2>
      <p><a href="#" class="text-secondary">Name of Course</a> > Name of Module</p>
    </div>

    <div class="row">
      <div class="col-md-8">
        <!-- Video Embed -->
        <div class="mb-3">
        <iframe width="100%" height="400" 
                src="https://www.youtube.com/embed/M-m7mcxreXA" 
                title="Lesson Video" 
                frameborder="0" 
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                allowfullscreen>
        </iframe>
        </div>

        <!-- Tabs -->
        <ul class="nav nav-tabs" id="lessonTabs" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="overview-tab" data-bs-toggle="tab" data-bs-target="#overview" type="button" role="tab">Overview</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="transcript-tab" data-bs-toggle="tab" data-bs-target="#transcript" type="button" role="tab">Transcript</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="audio-tab" data-bs-toggle="tab" data-bs-target="#audio" type="button" role="tab">Audio</button>
          </li>
        </ul>

        <div class="tab-content tab-content-box" id="lessonTabsContent">
          <div class="tab-pane fade show active" id="overview" role="tabpanel">
            <p>This lesson introduces how to establish your online brand as an entrepreneur. You’ll learn the basics of online presence and how branding influences your business.</p>
          </div>
          <div class="tab-pane fade" id="transcript" role="tabpanel">
            <p>[Transcript text of the video goes here.]</p>
          </div>
          <div class="tab-pane fade" id="audio" role="tabpanel">
            <audio controls>
              <source src="your-audio-file.mp3" type="audio/mpeg">
              Your browser does not support the audio element.
            </audio>
          </div>
        </div>

        <!-- Navigation -->
        <div class="mt-4 d-flex justify-content-between align-items-center">
          <button class="btn btn-danger">Next Lesson</button>
          <div>
            <span class="badge bg-danger">1</span>
            <span class="badge bg-secondary">2</span>
            <span class="badge bg-secondary">3</span>
          </div>
        </div>
      </div>

      <!-- Glossary -->
   
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
