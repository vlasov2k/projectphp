<?xml version="1.0" encoding="utf-8" ?>
<xsl:stylesheet 
    version="1.0" 
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:output 
    method="html"
    doctype-public="-//W3C//DTD HTML 4.01//EN"
    doctype-system="http://www.w3.org/TR/html4/strict.dtd"
    indent="yes" />

<!--шаблон корневого элемента-->
    <!-- <xsl:template match="/">
        <html>
            <head>
                <title>Наши книги</title>
                <style type="text/css">
                * {
                    margin: 0px;
                    padding: 0px
                }
                </style>
            </head>
        </html>
    </xsl:template>
 -->
<!--шаблон отрисовки книги стоимостью менее 200р-->
    <!-- <xsl:template match="book[prict &lt; 200]">
        <tr>
            <xsl:apply-temlates select="./*" />
        </tr>
    </xsl:template> -->
</xsl:stylesheet>