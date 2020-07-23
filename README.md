<p align="center"><b><h1>Blogging Website - PenIt</h1></b></p>

---

## About
A Blogging Webiste with numerous features and a great UI to please your eyes as one reads through the blogs, and a great platform for a writer to showcase their blogs.

---
# For a User POV:
- Register/Login and check the remember me so you dont have the troble to login again and again.
- Write a Blog or read through the blogs posted by other authors.
- Search your way to find what you are looking for.
- Filter out the blogs based on Tags/Categories
- Add a Category/Tag if you want.
- Restricted access to your materials, (blogs, profile).
- Schedule a blog to be posted in the future.
- By mistakely Deleted something you didnt want to? Go to the trashed section to recover it.
- Can comment on other's Post to give feedback and/or appreaciation.
---
# For a Developer POV:

## Post

### Model ###
- containes relationship methods: tags and categories which links them to have a many(Post):one(Category), many:many with tags and many:one with author(User)
- containes helper methods: delete image - to delete the image stored in my storage folder for all the posts.
- containes scope methods: scope published - used to extend a query function to filter the posts which should be published with current timestamp, scope search - to filter the posts based on the search query found.

### Controller ###
- A resourceful controller with standard functions of index, create, store, show, update,delete(SoftDelete) and destroy functionalities. 
- Create will store the post image name in the database and store the image in storage/public/posts folder which has a symlink with the public/posts to access with a view.
- Includes middleware authentication for validating the author whose post is being controlled to ensure that someone dosen't edit someone else's post.
- Used attach, detach and sync methods for many:many relations.
- Every show kind of function has paginate attached to it to paginate all the blogs nicely.

### Views ###
- Containes all views for resourceful routes...used trix writer for content create/edit field so as to provide all the tools for a true writer to write something beautiful.

## Category

### Model ###
- relationship methods: one:many with Post

### Category ###
again a resourceful controller with the same methods as mentioned in Posts Controller.

### Views ###
Standard views of edit, create, etc views created by bootstrap.

## Tags

Just the relation with post differs as compared to Category Section..
