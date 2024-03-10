import { __ } from "@wordpress/i18n";
import { useState } from "@wordpress/element";	
import {
  useBlockProps,
} from "@wordpress/block-editor";
import { Editor } from "./Components/Editor";


export default ({
    attributes,
    setAttributes
}) => {
    const blockProps = useBlockProps();
    const [ url, setUrl ] = useState(attributes.url || "");
    return (
        <figure {...blockProps}>
            <Editor 
                label="Lazy Load YouTube"
                onChange={e => setUrl(e.target.value)}
                value={url}
                onSubmit={e => {
                    setAttributes({
                        url
                    })
                    e.preventDefault();
                }}
            />
        </figure>
    )
}