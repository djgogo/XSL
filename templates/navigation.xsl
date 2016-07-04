<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

    <xsl:template name="navigation" match="*">

        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"> </span>
                        <span class="icon-bar"> </span>
                        <span class="icon-bar"> </span>
                    </button>
                    <a class="navbar-brand" href="/">Bibliothek</a>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="/bibliothek.php">List of Books</a></li>
                        <li><a href="enterBooks.php">Enter new Books</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                    <form class="navbar-form navbar-right" action="/bibliothek.php" role="search">
                        <div class="form-group">
                            <input type="text" name="search" class="form-control" placeholder="Search" />
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                </div><!--/.nav-collapse -->
            </div>
        </nav>

    </xsl:template>

</xsl:stylesheet>
