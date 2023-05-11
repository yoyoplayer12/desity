
        // Get the file input element
        const fileInput = document.getElementById('file-input');
        // Get the image element
        const img = document.getElementById('selected-image');
        // Add an event listener to the file input element
        fileInput.addEventListener('change', (event) => {
        // Get the selected file
        const selectedFile = event.target.files[0];
        if (selectedFile) {
            // A file has been selected
            console.log('File selected:', selectedFile.name);
            // Create a URL representing the selected file
            const imageURL = URL.createObjectURL(selectedFile);
            // Set the image source to the URL
            img.src = imageURL;
            // Show the image and hide the file input
            img.style.display = 'block';
            fileInput.style.display = 'none';
        } else {
            // No file has been selected
            console.log('No file selected');
            
            // Clear the image source and hide the image
            img.src = '';
            img.style.display = 'none';
            
            // Show the file input
            fileInput.style.display = 'block';
        }
        });