import { __, _x } from "@wordpress/i18n";
import { Button, Placeholder } from "@wordpress/components";
import { BlockIcon } from "@wordpress/block-editor";


export const Editor = ({
  icon,
  label,
  value,
  onChange,
  onSubmit,
}) => {
  const helpText = "Enter a YouTube video URL or an ID";
  return (
    <Placeholder
      icon={<BlockIcon icon={icon} showColors />}
      label={label}
      className="vesseldigital-lazyload-youtube"
      instructions={helpText}
    >
      <form
        className="vesseldigital-lazyload-youtube-form"
        onSubmit={onSubmit}
        style={{ gap: "8px" }}
      >
        <input
          type="text"
          value={value || ""}
          className="components-placeholder__input"
          aria-label={label}
          placeholder={helpText}
          onChange={onChange}
          style={{ flex: "1 1 auto" }}
        />
        <Button
          variant="primary"
          type="submit"
          className="components-placeholder__submit"
        >
          Save and Embed
        </Button>
      </form>
    </Placeholder>
  );
};

