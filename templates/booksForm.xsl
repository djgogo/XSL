<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

    <xsl:output
            method="html"
            doctype-public="XSLT-compat"
            omit-xml-declaration="yes"
            encoding="UTF-8"
            indent="yes" />

    <xsl:include href="header.xsl" />
    <xsl:include href="navigation.xsl" />

    <xsl:template match="/">
        <html>
            <xsl:call-template name="header"/>
        <body>
            <xsl:call-template name="navigation"/>

            <div class="container">

                <div class="wrapper">
                    <h1>Enter new Book</h1>

                    <form class="form-horizontal" action="/processBooksForm.php" method="post">

                        <div class="form-group">
                            <div class="col-sm-2 control-label">
                                <h3 class="text-info">Buchdetails</h3>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="author" class="col-sm-2 control-label">Author *</label>
                            <div class="col-xs-4">
                                <input type="text" class="form-control" id="author" name="author" value="{//form/field[@name='author']/value}" placeholder="Author"/>
                            </div>
                            <div class="text has-error">
                                <xsl:if test="//form/field[@name='author']/error != ''">
                                    <small class="help-block"><xsl:value-of select="//form/field[@name='author']/error"/></small>
                                </xsl:if>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="title" class="col-sm-2 control-label">Buchtitel *</label>
                            <div class="col-xs-4">
                                <input type="text" class="form-control" id="title" name ="title" value="{//form/field[@name='title']/value}" placeholder="Titel"/>
                            </div>
                            <div class="text has-error">
                                <xsl:if test="//form/field[@name='title']/error != ''">
                                    <small class="help-block"><xsl:value-of select="//form/field[@name='title']/error"/></small>
                                </xsl:if>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="genre" class="col-md-2 control-label">Genre</label>
                            <div class="col-xs-4">
                                <span class="input-group-btn">
                                    <select class="form-control" name="genre" id="genre">
                                        <option>
                                            <xsl:if test="//form/field[@name='genre']/computer = 'selected'">
                                                <xsl:attribute name="selected">selected</xsl:attribute></xsl:if>
                                            Computer
                                        </option>
                                        <option>
                                            <xsl:if test="//form/field[@name='genre']/fantasy = 'selected'">
                                                <xsl:attribute name="selected">selected</xsl:attribute></xsl:if>
                                            Fantasy
                                        </option>
                                        <option>
                                            <xsl:if test="//form/field[@name='genre']/romance = 'selected'">
                                                <xsl:attribute name="selected">selected</xsl:attribute></xsl:if>
                                            Romance
                                        </option>
                                        <option>
                                            <xsl:if test="//form/field[@name='genre']/horror = 'selected'">
                                                <xsl:attribute name="selected">selected</xsl:attribute></xsl:if>
                                            Horror
                                        </option>
                                        <option>
                                            <xsl:if test="//form/field[@name='genre']/scienceFiction = 'selected'">
                                                <xsl:attribute name="selected">selected</xsl:attribute></xsl:if>
                                            Science Fiction
                                        </option>
                                    </select>
                                </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="price" class="col-sm-2 control-label">Preis *</label>
                            <div class="col-xs-4">
                                <input type="text" class="form-control" id="price" name="price" value="{//form/field[@name='price']/value}" placeholder="Preis"/>
                            </div>
                            <div class="text has-error">
                                <xsl:if test="//form/field[@name='price']/error != ''">
                                    <small class="help-block"><xsl:value-of select="//form/field[@name='price']/error"/></small>
                                </xsl:if>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="publishDate" class="col-sm-2 control-label">Erscheinungsdatum *</label>
                            <div class="col-xs-2">
                                <input type="date" class="form-control" id="publishDate" name="publishDate" value="{//form/field[@name='publishDate']/value}" />
                            </div>
                            <div class="text has-error">
                                <xsl:if test="//form/field[@name='publishDate']/error != ''">
                                    <small class="help-block"><xsl:value-of select="//form/field[@name='publishDate']/error"/></small>
                                </xsl:if>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description" class="col-sm-2 control-label">Beschreibung *</label>
                            <div class="col-xs-5">
                                <textarea type="text" class="form-control" rows="3" id="description" name="description" value="{//form/field[@name='ort']/value}" placeholder="Beschreibung"/>
                            </div>
                            <div class="text has-error">
                                <xsl:if test="//form/field[@name='description']/error != ''">
                                    <small class="help-block"><xsl:value-of select="//form/field[@name='description']/error"/></small>
                                </xsl:if>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary">Erfassen</button>
                            </div>
                        </div>

                        <xsl:if test="//form/field[@name='message']/value != ''">
                            <div class="col-sm-offset-2 col-sm-10">
                                <p class="text-success"><xsl:value-of select="//form/field[@name='message']/value" /></p>
                            </div>
                        </xsl:if>

                    </form>

                </div>

            </div><!-- /.container -->

        </body>
        </html>
    </xsl:template>

</xsl:stylesheet>
